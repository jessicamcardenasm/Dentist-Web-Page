<?php
 

class AuthController extends BaseController {
 
    public function showLogin()
    {
        // Verificamos si hay sesión activa
        if (Auth::check())
        {
            // Si tenemos sesión activa mostrará la página de inicio
            return Redirect::to('HomeCockpit');
        }
        // Si no hay sesión activa mostramos el formulario
        return View::make('login');
    }
 
    public function postLogin()
    {
        // Obtenemos los datos del formulario
        $data = [
            'username' => Input::get('username'),
            'password' => Input::get('password')
        ];
 
        // Verificamos los datos
        if (Auth::attempt($data, Input::get('remember')))
         // Como segundo parámetro pasámos el checkbox para sabes si queremos recordar la contraseña
        {
            // Si nuestros datos son correctos mostramos la página de inicio
            switch(Auth::user()->tipo){
            case 1:
            return Redirect::intended('HomeCockpit');break;
            
            }
        }
        // Si los datos no son los correctos volvemos al login y mostramos un error
        return Redirect::back()->with('error_message', 'Invalid data')->withInput();
    }
 
    public function logOut()
    {
        // Cerramos la sesión
        Auth::logout();
        // Volvemos al login y mostramos un mensaje indicando que se cerró la sesión
        return Redirect::to('login')->with('error_message', 'Logged out correctly');
    }

    public function createUser(){

        $data=Input::all();

        $reglas=array("username"=>"alpha","email"=>"email","password"=>"alpha_num");

        $v=Validator::make($data,$reglas);
        if($v->passes()){
            $user=new User;
            $user->tipo=1;
            $user->username=$data['username'];
            $user->email=$data['email'];
            $user->password=Hash::make($data["password"]);
            $user->save();
           
        }
           return Redirect::to("login")->withErrors($v);
            
    }

}