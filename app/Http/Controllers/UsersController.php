<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
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
        //Encriptamos la contraseña
        $user->password = bcrypt($request->password);
        //Guardamos7
        $user->save();
        //Imprimimos
        dd('Usuario Registrado');

    }

    public function show($id){
        
    }

    public function edit($id){

    }

    public function update(Request $request, $id){
        
    }

    public function destroy($id){

    }
}
