<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function RegisterShow(){
        return view('auth.register');
    }

    public function LoginShow() {
        return view('auth.login');   
    }

    public function Register(RegisterRequest $request){
        $data = $request->validated();
        User::create( [
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => $data['password'],
            'address' => $data['address'],
            'phone' => $data['phone'],
        ]);
        return redirect('/login')->withSuccess('Kayıt İşlemi Başarılı Şimdi Giriş Yaparak OnlineMerketi Kullanın.');
    }

    public function Login(Request $request){
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($validate)){
            $request->session()->regenerate();
            return redirect('/');
        }
        return redirect()->back()->withErrors('Email veya Şifreniz Hatalı !!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
