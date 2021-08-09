<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\admins;
use \App\Models\Employee;
use \App\Models\States;
use \App\Models\Cities;
use \App\Models\Timesheet;
use \App\Models\Breaktime;
use \App\Models\Lunch;
use Session;
use Hash;


class UserController extends Controller
{
    // # Bind the  Model
    protected $employee;
    protected $timesheet;
    protected $breaktime;
    protected $lunch;

    public function __construct(admins $admins, Employee $employee, States $state, Cities $citie, Timesheet $timesheet, Breaktime $breaktime, Lunch $lunch)
    {
        $this->admins = $admins;
        $this->employee = $employee;
        $this->state = $state;
        $this->citie = $citie;
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
        if (Auth::guard('emp')->attempt($credentials) && Auth::guard('emp')->user()->status == '1') {
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
            Auth::guard('emp')->logout();
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
            $user_id = Auth::guard('emp')->id();
            $breaks = $this->breaktime->where('emp_id', $user_id)->get();
            $lunch = $this->lunch->where('emp_id', $user_id)->get();
            $signin = $this->timesheet->where('emp_id', $user_id)->get();
            return view('User/dashboard', ['lunch' => $lunch, 'breaks' => $breaks, 'signin' => $signin]);
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

    public function profile()
    {     
            $user_id = Auth::guard('emp')->id();
            $emp_details = $this->employee->where('id', $user_id)->first();
            $states = $this->state::get();
            $gcity = $emp_details->grad_state;
            $mcity = $emp_details->mas_state;
            $gradcity = $this->citie->where('state_id', $gcity)->get();
            $mascity = $this->citie->where('state_id', $mcity)->get();
            // dd($gradcity);
            return view('User/profile', ['emp_details' => $emp_details, 'states' => $states, 'gradcity' => $gradcity, 'mascity' => $mascity]);
    }

    public function editemployeePost(Request $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try {
            $data = [
                'first_name'        => $input['inputFname'] ?? null,
                'last_name'         => $input['inputLname'] ?? null,
                'phone'             => $input['inputPhone'] ?? null,
            ];
            if (isset($input['inputPassword']) && !empty($input['inputPassword'])) {
                $data['password'] = bcrypt($input['inputPassword']) ?? null;
            } else {
            }
            if ($request->hasfile('inputProfilepic')) {
                $file = $request->file('inputProfilepic');
                $filename = ((string)(microtime(true) * 10000)) . "-" . $file->getClientOriginalName();
                $file->move('images/', $filename);
                $secondary_file = 'images/' . $filename;
                $data['profile_pic'] = $secondary_file;
            }
                $update = $this->employee::where('id', $input['record_id'])->update($data);
            DB::commit();
            return redirect()->back()->with("Employees Added Successfully");
        } catch (Exception $e) {
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
        // Session::flush();
        Auth::guard('emp')->logout();
  
        return Redirect('login');
    }
}
