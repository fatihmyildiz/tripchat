<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\Admin;



class AdminAuthController extends Controller
{
    /**
     * Display login of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function login(){
        $title = "Login";
        $description = "Some description for the page";
        return view('auth.adminlogin',compact('title','description'));
    }

    /**
     * Display register of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function register(){
        $title = "Register";
        $description = "Some description for the page";
        return view('auth.register',compact('title','description'));
    }

    /**
     * Display forget password of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function forgetPassword(){
        $title = "Forget Password";
        $description = "Some description for the page";
        return view('auth.forget_password',compact('title','description'));
    }

    /**
     * make the user able to register
     *
     * @return 
     */
    public function signup(Request $request)
{
    $validators = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email|unique:admins', // Tabloyu admins olarak değiştirdik
        'password' => 'required'
    ]);

    if ($validators->fails()) {
        return redirect()->route('register')->withErrors($validators)->withInput();
    } else {
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();

        auth()->guard('admins')->login($admin);

        return redirect()->intended(route('dashboard.mod_homepage', 'tr'))->with('message', 'Registration was successful!');
    }
}


    /**
     * make the user able to login
     *
     * @return 
     */
     public function authenticate(Request $request){
        $validators=Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if($validators->fails()){
            return redirect()->route('login')->withErrors($validators)->withInput();
        }else{
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password], true, 'admins')){
        // Kullanıcı doğrulama başarılı
        return redirect()->intended(route('dashboard.demo_one','tr'))->with('message','Welcome back!');
        } else {
            // Kullanıcı doğrulama başarısız
            return redirect()->route('login')->with('message','Login failed! Email/Password is incorrect!');
        }

        }
    }


    /**
     * make the user able to logout
     *
     * @return 
     */
    public function logout(){  
        Auth::logout(); 
        return redirect()->route('login')->with('message','Successfully Logged out !');       
    }
}