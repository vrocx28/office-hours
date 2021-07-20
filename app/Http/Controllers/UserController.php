<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use \App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;


class UserController extends Controller
{
    // # Bind the  Model
    protected $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function userLoginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::guard('emp')->attempt($credentials)&& Auth::guard('emp')->status = '1') {
            return redirect('dashboard');    
        }else{
            return redirect("login")
            ->withSuccess('Oppes! You have entered invalid credentials');
        }
    }

    public function userLogin(){ 
        if(Auth::guard('emp')->user()){
            return redirect('dashboard');
        }else{
            return view('User/userlogin');
        }
    }

    public function userDashboard(){ 
        
        if(Auth::guard('emp')->user()){
            return view('User/dashboard');
        }else{
            return redirect("userlogin")
                        ->withSuccess('Opps! You do not have access');
        }
    }

    public function empLogout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
