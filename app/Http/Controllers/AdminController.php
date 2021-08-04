<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use \App\Models\admins;
use \App\Models\Employee;
use \App\Models\States;
use \App\Models\Cities;
use \App\Models\Timesheet;
use \App\Models\Breaktime;
use \App\Models\Lunch;
use Illuminate\Support\Facades\Auth;
use Session;
use Hash;

class AdminController extends Controller
{
    # Bind the Model
    protected $admins;
    protected $employee;
    protected $state;
    protected $citie;
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

    public function adminLoginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (!Auth::guard('admin')->attempt($credentials)) {
            return redirect("adminlogin")->withErrors('Invalid Username or Password');
        } else {
            return redirect('admin');
        }
    }

    public function adminLogin()
    {
        if (Auth::guard('admin')->user()) {
            return redirect('admin');
        } else {
            return view('Admin/adminlogin');
        }
    }

    public function adminDashboard()
    {
        $emp_data= $this->employee::get();
        return view('Admin/admin',['emp_data'=>$emp_data]); 
    }

    public function addEmployee()
    {
        $states= $this->state::get();
        return view('Admin/addemployee',['states'=>$states]);
    }

    public function verifyperemail(Request $request)
    {
        $input = $request->all();
        $per_email = $this->employee::where('personal_email', $input['peremail'])->count();
        if ($per_email > 0) {
            return $response = ['status' => '500',];
        }else{
            return $response = ['status' => '200',];
        }
    }

    public function verifyemail(Request $request)
    {
        $input = $request->all();
        $email = $this->employee::where('email', $input['email'])->count();
        if ($email > 0) {
            return $response = ['status' => '500',];
        }else{
            return $response = ['status' => '200',];
        }
    }

    public function getCityList(Request $request)
    {
        $input = $request->all();
        if(isset($input['state_id']) && $input['state_id'] > 0){
            $all_cities = $this->citie::where('state_id', $input['state_id'])->get();
            $html = '<option value="">Select</option>';
            foreach($all_cities as $city){
                $html = $html.'<option value="'.$city->id.'">'.$city->city.'</option>';
            }
            return $response = [
                'cities_list' => $html,
            ];
        }
    }

    public function employeePost(Request $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try 
        {
            $data = [
                'first_name'        => $input['inputFname'] ?? null,
                'last_name'         => $input['inputLname'] ?? null,
                'personal_email'    => $input['inputPerEmail'] ?? null,
                'email'             => $input['inputComEmail'] ?? null,
                'designation'       => $input['inputDesignation'] ?? null,
                'employee_id'       => $input['inputEmployeeID'] ?? null,
                'department'        => $input['inputDepartment'] ?? null,
                'joining_date'      => $input['inputJDate'] ?? null,
                'status'            => $input['inputStatus'] ?? null,

                'grad_college_name' => $input['inputGradCollege'] ?? null,
                'grad_degree'       => $input['inputGradDegree'] ?? null,
                'grad_passing_year' => $input['inputGradPassYear'] ?? null,
                'grad_state'        => $input['inputGradState'] ?? null,
                'grad_city'         => $input['inputGradCity'] ?? null,

                'mas_college_name'  => $input['inputMasCollege'] ?? null,
                'mas_degree'        => $input['inputMasDegree'] ?? null,
                'mas_passing_year'  => $input['inputMasPassYear'] ?? null,
                'mas_state'         => $input['inputMasState'] ?? null,
                'mas_city'          => $input['inputMasCity'] ?? null,
            ];

            if(isset($input['record_id']) && !empty($input['record_id'])){
            }else{
                $data['password'] = bcrypt($input['inputPassword'])??null;
            }
            if($request->hasfile('inputProfilepic')) {
                $file = $request->file('inputProfilepic');
                $filename = ((string)(microtime(true) * 10000)) . "-" . $file->getClientOriginalName();
                $file->move('images/', $filename);
                $secondary_file = 'images/' . $filename;
                $data['profile_pic'] = $secondary_file;
            }
            if(isset($input['record_id']) && !empty($input['record_id'])){
                $update = $this->employee::where('id', $input['record_id'])->update($data);
            }else{
                $save =  $this->employee::create($data);
            }
            DB::commit();
            return redirect()->back()->with("Employees Added Successfully");
        } catch (Exception $e) {
            // Rollback Transaction
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function viewEmployee($id)
    {
        $emp_details = $this->employee->where('id',$id)->first();
        $breaks = $this->breaktime->where('emp_id',$id)->get();
        $lunch = $this->lunch->where('emp_id',$id)->get();
        $signin = $this->timesheet->where('emp_id',$id)->get();
        $states= $this->state::get();
        // dd($cities);
        return view('Admin/viewemployee',['lunch'=>$lunch,'breaks'=>$breaks,'signin'=>$signin, 'emp_details'=>$emp_details,'states'=>$states]);
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('adminlogin');
    }

}
