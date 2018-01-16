<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Laracasts\Flash\Flash;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('auth')->only('profile', 'update_profile');
    }

    /*
    *
    * Funciones Predeterminadas
    *
    */

    public function index(){
        //Obtenemos los datos de la BD ordenandolos por id ascendentemente
        //Seleccionamos una pagination de 5 usuarios
        $users = User::orderBy('id', 'ASC')->paginate(5);
        return view('admin.users.index')->with('users', $users);
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(Request $request){
        //Obtenemos los datos del formulario
        $user = new User($request -> all());
        $secondpass = $request -> input('secondpass');
        //Verificamos Contraseña
        if(self::validarDatosContraseña($user->password, $secondpass)){
            //Encriptamos la contraseña
            $user->password = bcrypt($request->password);
            //Guardamos validando el estatus del usuario
            try{
                //dd($user);
                $user->save();
            }catch(\Exception $e){
                //Error al registrar usuario
                dd($e);
                Flash('¡ Error al registrar usuario; verifique su conexión de internet, 
                si persiste la falla pongase en contacto con el administrador !')->error();
                //Redireccionamos
                return redirect()->route('users.create');
                Log::info($e);
            }
            //Imprimimos mensaje flash
            Flash('¡ Se a registrado a ' . $user->username . ' de forma exitosa !')->success();
            //Redireccionamos
            return redirect()->route('users.index');
        }else{
            //Error debido a que los campos de contraseña no son correctos
            Flash('¡ Contraseña no es igual en el segundo campo, verifique sus datos !')->error();
            //Redireccionamos
            return redirect()->route('users.create');
        }
    }

    public function show($id){
        //Buscamos y obtenemos los datos del ususario
        $user = User::find($id);
        //Retornamos vista para mostrat datos
        return view('admin.users.show') -> with('user', $user);
    }

    public function edit($id){
        //Buscamos el usuario en la base de datos y lo obtenemos
        $user = User::find($id);
        //Validamos
        if( !empty ( $user ) ){
            return view('admin.users.edit') -> with('user', $user);
        }else{
            //Error debido a la inexistencia del usuario en la base de datos
            Flash('¡ Error al editar usuario, pongase en contacto con el Administrador del Sistema !')->error();
            //Redireccionamos
            return redirect()->route('users.edit');
        }
    }

    public function update(Request $request, $id){
        try{
            //Buscamos al usuario y obtenemos sus datos de la BD
            $user = User::find($id);
            //Creamos variable para el segundo campo de contraseña
            $secondpass = $request -> input('secondpass');
            if( !empty ( $user ) ){
                //Validamos ambos campos de contraseña
                if(self::validarDatosContraseña($request->password, $secondpass)){
                    //Siendo correcto empezamos a obtener datos
                    $user->name = $request->name;
                    $user->username = $request->username;
                    $user->email = $request->email;
                    $user->member = $request->member;
                    $user->address = $request->address;
                    $user->phone = $request->phone;
                    //Encriptamos la contraseña
                    $user->password = bcrypt($request->password);
                    //Guardamos
                    try{
                        $user->save();
                    }catch(\Exception $e){
                        //Error al registrar usuario
                        Flash('¡ Error al editar usuario; verifique su conexión de internet, 
                        si persiste la falla pongase en contacto con el administrador !')->error();
                        //Redireccionamos
                        return redirect()->route('users.edit', $user);
                    }
                    //Imprimimos mensaje flash
                    Flash('¡ Se cambiaron los datos al usuario ' . $user->username . ' de forma exitosa !')->important();
                    //Redireccionamos
                    return redirect()->route('users.index');
                }else{
                    //Error debido a que los campos de contraseña no son correctos
                    Flash('¡ Contraseña no es igual en el segundo campo, verifique sus datos !')->error();
                    //Redireccionamos
                    return redirect()->route('users.edit', $user);
                }
                
            }
        }catch(\Exception $e){
            //Error al intentar editar usuario
            Flash('¡ Error al editar usuario, pongase en contacto con el Administrador del Sistema !')->error();
            //Redireccionamos
            return redirect()->route('users.edit');
        }
        
    }

    public function destroy($id){
        try{
            //Revisamos en la base de datos la existencia del usuario
            $user = User::find($id);
            //Validamos si existe en la base de datos el usuario
            if( !empty ( $user ) ){
                $user->delete();
                //Imprimimos mensaje flash
                Flash('¡ Se eliminó a ' . $user->username . ' de forma correcta !')->warning();
                //Redireccionamos
                return redirect()->route('users.index');
            }else{
                //Error debido a la inexistencia del usuario en la base de datos
                Flash('¡ Error al eliminar usuario, pongase en contacto con el Administrador del Sistema !')->error();
                //Redireccionamos
                return redirect()->route('users.index');
            }
            
        }catch(\Exception $e){
            //Error al intentar eliminar usuario
            Flash('¡ Error al eliminar usuario, pongase en contacto con el Administrador del Sistema !')->error();
            //Redireccionamos
            return redirect()->route('users.index');
        }
    }

    /*
    *
    * Funciones Personalizadas
    *
    */

    //Funciones para la Foto de Perfil de los Usuarios
    //Funcion para mostrar la foto de perfil logeandose a la vista
    public function profile() {
        //Tomamos el campo del ususario
        $user = Auth::user();
        //Retornamos la vista con el profile
        return view('admin.users.profile', ['user' => $user]);
    }

    //Funcion para Actualizar la foto de perfil del usuario
    public function update_profile(Request $request) {
        //Validsmo el archivo, sus formatos, y su tamaño maximo de 2MB
        $this->validate($request, [
          'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
     
        //Lo sube a la carpeta de avatares
        $filename = Auth::id().'_'.time().'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('uploads/avatars'), $filename);
     
        //Termina guardando lo anterior en la base de datos
        $user = Auth::user();
        $user->avatar = $filename;
        $user->save();
     
        //Mandamos Mensaje de Confirmación
        Flash('¡ La Foto de Perfil a cambiado !')->success();
        //Redireccionamos
        return redirect()->route('users.index');
    }

    //Funciones de Validación de Datos del Usuario
    private function validarDatosContraseña($pass1, $pass2){
        if($pass1 == $pass2){
            return true;
        }else{
            return false;
        }
    }
}
