<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use \App\Models\Employee;
use \App\Models\Timesheet;
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;


class UserController extends Controller
{
    // # Bind the  Model
    protected $employee;
    protected $timesheet;

    public function __construct(Employee $employee, Timesheet $timesheet)
    {
        $this->employee = $employee;
        $this->timesheet = $timesheet;
    }

    public function userLoginPost(Request $request){
        date_default_timezone_set('Asia/Kolkata');
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::guard('emp')->attempt($credentials)&& Auth::guard('emp')->status = '1') {
            DB::beginTransaction();
            try 
            {
                $user_details = Auth::guard('emp')->id();
                $today_date = date('Y-m-d');
                $current_time = explode(" ", date('h:i a', time()));
                $login_time = $current_time[0];
                $am_pm = $current_time[1];
                $data = [
                    'emp_id'      =>  $user_details,
                    'login_date'  =>  $today_date??null,
                    'login_time'  =>  $login_time??null,
                    'login_hour'  =>  $am_pm??null,
                ];
                $save =  $this->timesheet::create($data);
                DB::commit();      
                return redirect('dashboard'); 
            }catch (Exception $e) {
                // Rollback Transaction
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            } 
        }else{
            return redirect("login")->withErrors('Invalid Username or Password');
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
            return redirect("userlogin")->withErrors('Opps! You do not have access');
        }
    }

    public function empLogout() {
        date_default_timezone_set('Asia/Kolkata');
        DB::beginTransaction();
            try 
            {
                $user_id = Auth::guard('emp')->id();
                $user_details = $this->timesheet->where('emp_id',$user_id)->latest('id')->first();
                $today_date = date('Y-m-d');
                $current_time = explode(" ", date('h:i a', time()));
                $logout_time = $current_time[0];
                $am_pm = $current_time[1];
                $data = [
                    'logout_time'  =>  $logout_time??null,
                    'logout_hour'  =>  $am_pm??null,
                ];
                    $update = $this->timesheet::where('id', $user_details->id)->where('login_date', $today_date)->update($data);
                DB::commit();
            }catch (Exception $e) {
                // Rollback Transaction
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            } 
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
