<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash; // for securing password
//use Illuminate\Auth\SessionGuard;
// use Illuminate\Contracts\Session\Session as SessionSession;
use Session;
//App\Http\Controllers\Session;
use Illuminate\Support\Facades\Hash as FacadesHash;
// use Illuminate\Support\Facades\Session as FacadesSession;
// use Symfony\Component\HttpFoundation\Session\Session as HttpFoundationSessionSession;

class CustomAuthController extends Controller
{
    public function login(){
        return view("auth.login");

    }
    public function registration(){
        return view("auth.registration");

        
    }
    public function registerUser(Request $request){
$request->validate([
    'name'=>'required',
    'email'=>'required|email|unique:users',
    'password'=>'required|min:5|max:12',


]);
$user= new User();
$user->name=$request->name;
$user->email=$request->email;
$user->password= FacadesHash::make($request->password);
$res=$user->save();
if($res){
return back() ->with('success','You have registerd successfully');

}else{
    return back() ->with('fail','Somthinf worng');

}
    }
public function loginUser(Request $request){
    $request->validate([
        'email'=>'required|email',
        'password'=>'required|min:5|max:12',
    
    ]);
    $user= User::where('email','=',$request->email)->first();
    if($user){
        if(FacadesHash::check($request->password,$user->password)){
            $request->session()->put('loginId', $user->id);
            return redirect('dashboard');

        }else{
            return back() ->with('fail','password not match');

        }

    }else{
        return back() ->with('fail','This email is not registerd');

    }
}
public function dashboard(){
    
    return view('dashboard');
}
public function logout(){
   
      return  redirect('login');

    }
}

    

