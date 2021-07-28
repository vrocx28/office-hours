<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use \App\Models\Employee;
use \App\Models\Timesheet;
use \App\Models\Breaktime;
use \App\Models\Lunch;
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;


class UserController extends Controller
{
    // # Bind the  Model
    protected $employee;
    protected $timesheet;
    protected $breaktime;
    protected $lunch;

    public function __construct(Employee $employee, Timesheet $timesheet, Breaktime $breaktime, Lunch $lunch)
    {
        $this->employee = $employee;
        $this->timesheet = $timesheet;
        $this->breaktime = $breaktime;
        $this->lunch = $lunch;
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

    public function userLogin()
    { 
        if(Auth::guard('emp')->user()){
            return redirect('dashboard');
        }else{
            return view('User/userlogin');
        }
    }

    public function userDashboard()
    {     
        if(Auth::guard('emp')->user()){
            $user_id = Auth::guard('emp')->id();
            $break = $this->breaktime->where('emp_id',$user_id)->get();
            $lunch = $this->lunch->where('emp_id',$user_id)->get();
            $signin = $this->timesheet->where('id',$user_id)->get();
            return view('User/dashboard',['lunch'=>$lunch],['breaks'=>$break],['signin'=>$signin]);
        }else{
            return redirect("userlogin")->withErrors('Opps! You do not have access');
        }
    }

    public function changeBreakButton()
    {
        $user_id = Auth::guard('emp')->id();
        $user_details = $this->breaktime->where('emp_id',$user_id)->latest('id')->first();
        $last_break = $user_details->break_end;
        if ($last_break != null) {
            return $response = ['status' => '500',];
        }else{
            return $response = ['status' => '200',];
        }
    }

    public function takeabreak()
    {
        date_default_timezone_set('Asia/Kolkata');
        DB::beginTransaction();
            try 
            {
                $user_details = Auth::guard('emp')->id();
                $today_date = date('Y-m-d');
                $current_time = explode(" ", date('h:i a', time()));
                $break_start = $current_time[0];
                $am_pm = $current_time[1];
                $data = [
                    'emp_id'      =>  $user_details,
                    'date'  =>  $today_date??null,
                    'break_start'  =>  $break_start??null,
                    'start_hour'  =>  $am_pm??null,
                ];
                $save =  $this->breaktime::create($data);
                DB::commit();      
                return redirect('dashboard'); 
            }catch (Exception $e) {
                // Rollback Transaction
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            } 
    }

    public function endbreak()
    {
        date_default_timezone_set('Asia/Kolkata');
        DB::beginTransaction();
            try 
            {
                $user_id = Auth::guard('emp')->id();
                $user_details = $this->breaktime->where('emp_id',$user_id)->latest('id')->first();
                $today_date = date('Y-m-d');
                $current_time = explode(" ", date('h:i a', time()));
                $break_end = $current_time[0];
                $am_pm = $current_time[1];
                $data = [
                    'break_end'  =>  $break_end??null,
                    'end_hour'  =>  $am_pm??null,
                ];
                    $update = $this->breaktime::where('id', $user_details->id)->where('date', $today_date)->update($data);
                DB::commit();
            }catch (Exception $e) {
                // Rollback Transaction
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            } 
    }

    public function changeLunchButton(){
        $user_id = Auth::guard('emp')->id();
        $user_details = $this->lunch->where('emp_id',$user_id)->latest('id')->first();
        $last_lunch = $user_details->lunch_end;
        if ($last_lunch != null) {
            return $response = ['status' => '500',];
        }else{
            return $response = ['status' => '200',];
        }
    }

    public function startlunch()
    {
        date_default_timezone_set('Asia/Kolkata');
        DB::beginTransaction();
            try 
            {
                $user_details = Auth::guard('emp')->id();
                $today_date = date('Y-m-d');
                $current_time = explode(" ", date('h:i a', time()));
                $break_start = $current_time[0];
                $am_pm = $current_time[1];
                $data = [
                    'emp_id'      =>  $user_details,
                    'date'  =>  $today_date??null,
                    'lunch_start'  =>  $break_start??null,
                    'start_hour'  =>  $am_pm??null,
                ];
                $save =  $this->lunch::create($data);
                DB::commit();      
                return redirect('dashboard'); 
            }catch (Exception $e) {
                // Rollback Transaction
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            } 
    }

    public function endlunch()
    {
        date_default_timezone_set('Asia/Kolkata');
        DB::beginTransaction();
            try 
            {
                $user_id = Auth::guard('emp')->id();
                $user_details = $this->lunch->where('emp_id',$user_id)->latest('id')->first();
                $today_date = date('Y-m-d');
                $current_time = explode(" ", date('h:i a', time()));
                $break_end = $current_time[0];
                $am_pm = $current_time[1];
                $data = [
                    'lunch_end'  =>  $break_end??null,
                    'end_hour'  =>  $am_pm??null,
                ];
                    $update = $this->lunch::where('id', $user_details->id)->where('date', $today_date)->update($data);
                DB::commit();
            }catch (Exception $e) {
                // Rollback Transaction
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            } 
    }

    public function empLogout() 
    {
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
