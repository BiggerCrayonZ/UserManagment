<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Laracasts\Flash\Flash;

/* /////////////////////////////////////////////
*
*   Author:  Raúl Enrique Reza del Castillo
*   E-mail: raul.reza.delcastillo@gmail.com
*
*///////////////////////////////////////////////


class UsersController extends Controller
{

    public function __construct()
    {
        //Asignamos validaciones previas pasando por Auth como medio de autentificación.
        $this->middleware('auth');
        $this->middleware('auth')->only('profile', 'update_profile');
    }

    /*
    *
    * Funciones Predeterminadas
    *
    */      

    public function index(){
        /*
        *   Funcion para Enlistar Usuarios
        */
        //Obtenemos los datos de la BD ordenandolos por id ascendentemente
        //Seleccionamos una pagination de 5 usuarios
        $users = User::orderBy('id', 'ASC')->paginate(5);
        return view('admin.users.index')->with('users', $users);
    }

    public function create(){
        //Retorna a la vista para el formulario de creación de usuarios
        return view('admin.users.create');
    }

    public function store(Request $request){
        /*
        *   Funcion para Insertar en la BD
        */
        //Obtenemos los datos del formulario
        $user = new User($request -> all());
        //Validamos el campo de telefono
        if(strlen($user->phone) > 10){
            //Error al registrar usuario
            Flash('¡ Error en el campo de teléfono, ya que tiene más de 10 caracteres. Verifíque su información !')->error();
            //Redireccionamos
            return redirect()->route('users.create');
        }else{
            //Validamos campo de contraseña en cuanto al numero de caracteres
            if(strlen($user->password) <= 10 and strlen($user->password) >= 6){
                //Obtenemos la segunda contraseña para evaluación
                $secondpass = $request -> input('secondpass');
                //Verificamos Contraseña
                if(self::validarDatosContraseña($user->password, $secondpass)){
                    //Encriptamos la contraseña
                    $user->password = bcrypt($request->password);
                    //Guardamos validando el estatus del usuario
                    try{
                        //Guardamos en BD
                        $user->save();
                    }catch(\Exception $e){
                        //Error al registrar usuario
                        Flash('¡ Error al registrar usuario; verifique su conexión de internet, 
                        si persiste la falla pongase en contacto con el administrador !')->error();
                        //Redireccionamos
                        return redirect()->route('users.create');
                        //Mandamos al Log
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
            }else{
                //Error debido a que los campos de contraseña no son correctos
                Flash('¡ Contraseña con numero incorrecto de caracteres, verifíque su información !')->error();
                //Redireccionamos
                return redirect()->route('users.create');
            }
            
        }
        
    }

    public function show($id){
        /*
        *   Funcion para Traer información de la BD
        */
        //Buscamos y obtenemos los datos del ususario
        $user = User::find($id);
        //Retornamos vista para mostrat datos
        return view('admin.users.show') -> with('user', $user);
    }

    public function edit($id){
        /*
        *   Funcion para Editar Usuario
        */
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
        /*
        *   Funcion para Actualizar Usuarios
        */
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
        /*
        *   Funcion para Eliminar Usuarios
        */
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
