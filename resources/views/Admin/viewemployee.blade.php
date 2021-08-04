<!DOCTYPE html>
@extends('adminlayout')
@include('footer')
@section('content')

<div class="container mt-5">
   <a href="{{route('admin')}}" class="btn btn-primary">&#8592; Back</a>
   <button type="button" class="btn btn-primary" id="editbutton" onclick="editprofile();">Edit Details</button>
</div>

<div class="container mt-5 edit">
   
   <form class="row g-3" id="AddEmp"  action="{{ route('employee-post') }}" autocomplete="off" enctype="multipart/form-data" method="post">
      <div class="col-md-2">
         @if(!empty($emp_details->profile_pic))
         <img src="{{url('')}}/{{$emp_details->profile_pic}}" alt="..." style="width:180px">
         @else
         <img src="{{url('')}}/images/project_images/stock.jpg" alt="..." style="width:180px">
         @endif
      </div>
      @csrf
      <input type="hidden" name="record_id" value="{{$emp_details->id??''}}">
      <div class="col-md-3">
         <label for="inputFname" class="form-label">First Name</label>
         <input type="text" class="form-control" id="inputFname" name="inputFname" value="{{$emp_details->first_name??''}}">
      </div>
      <div class="col-md-3">
         <label for="inputLname" class="form-label">Last Name</label>
         <input type="text" class="form-control" id="inputLname" name="inputLname" value="{{$emp_details->last_name??''}}">
      </div>
      <div class="col-5">
         <label for="inputPerEmail" class="form-label">Personal Email</label>
         <input type="email" class="form-control" name="inputPerEmail" onkeyup="checkperemail(this)" value="{{$emp_details->personal_email??''}}">
         <label id="error-msg" class="chkeml" style="color:red"></label>
      </div>
      <div class="col-5">
         <label for="inputComEmail" class="form-label">Company Email</label>
         <input type="email" class="form-control" name="inputComEmail" onkeyup="checkemail(this)" value="{{$emp_details->email??''}}">
         <label id="error-msg" class="eml" style="color:red"></label>
      </div>
      <div class="col-md-2">
         <label for="inputStatus" class="form-label">Status</label>
         <select id="inputStatus" name="inputStatus" class="form-select">
            <option selected value="">Choose...</option>
            <option value="1" {{($emp_details->status == 1) ? 'selected' : ''}}>Active</option>
            <option value="0" {{($emp_details->status == 0) ? 'selected' : ''}}>Inactive</option>
         </select>
      </div>
      <div class="col-md-4">
         <label for="inputDesignation" class="form-label">Designation</label>
         <input type="text" class="form-control" id="inputDesignation" name="inputDesignation" value="{{$emp_details->designation??''}}">
      </div>
      <div class="col-md-4">
         <label for="inputEmployeeID" class="form-label">Employee ID</label>
         <input type="text" class="form-control" id="inputEmployeeID" name="inputEmployeeID" value="{{$emp_details->employee_id??''}}">
      </div>
      <!-- <div class="col-md-6">
         <label for="inputProfilepic" class="form-label">Upload pic</label>
         <input type="file" class="form-control" id="inputProfilepic" name="inputProfilepic" accept="image/*">
      </div> -->
      <div class="col-md-2">
         <label for="inputDepartment" class="form-label">Department</label>
         <select id="inputDepartment" name="inputDepartment" class="form-select">
            <option selected value="">Choose...</option>
            <option value='Design' {{($emp_details->department == 'Design') ? 'selected' : ''}}>Design</option>
            <option value='Develpoment' {{($emp_details->department == 'Develpoment') ? 'selected' : ''}}>Develpoment</option>
            <option value='Management' {{($emp_details->department == 'Management') ? 'selected' : ''}}>Management</option>
            <option value='Marketing' {{($emp_details->department == 'Marketing') ? 'selected' : ''}}>Marketing</option>
         </select>
      </div>
      <div class="col-md-2">
         <label for="inputEmployeeID" class="form-label">Joining Date</label>
         <input type="date" class="form-control" id="inputJDate" name="inputJDate" value="{{$emp_details->joining_date??''}}">
      </div>

      <div class="col-md-12">
         <h5>Graduation Details</h5>
      </div>
      <div class="col-md-4">
         <label for="inputGradCollege" class="form-label">College Name</label>
         <input type="text" class="form-control" id="inputGradCollege" name="inputGCollege" value="{{$emp_details->grad_college_name??''}}">
      </div>
      <div class="col-md-2">
         <label for="inputGDegreeName" class="form-label">Select Degree</label>
         <select id="inputGradDegree" name="inputGradDegree" class="form-select">
            <option selected value="">Choose...</option>
            <option value='B.tech' {{($emp_details->grad_degree == 'B.tech') ? 'selected' : ''}}>B.tech</option>
            <option value='BCA' {{($emp_details->grad_degree == 'BCA') ? 'selected' : ''}}>BCA</option>
         </select>
      </div>
      <div class="col-md-1">
         <label for="inputGradPassYear" class="form-label">Passing year</label>
         <select id="inputGradPassYear" name="inputGradPassYear" class="form-select passyear">
            <option value="">Select...</option>
            {{ $year = date('Y') }}
            @for ($i = 1990; $i <= $year; $i++) <option value='{{$i}}' {{($emp_details->grad_passing_year == $i) ? 'selected' : ''}}>{{$i}}</option>
               @endfor
         </select>
      </div>
      <div class="col-md-2">
         <label for="inputGradState" class="form-label">State</label>
         <select id="inputGradState" name="inputGradState" class="form-select" data-live-search="true" onchange="getCityLIstFromStateId(this)">
            <option value="">Select</option>
            @if(!empty($states) && count($states) > 0)
            @foreach($states as $state)
            <option value="{{$state->id}}" {{($emp_details->grad_state == $state->id) ? 'selected' : ''}}>{{$state->state}}</option>
            @endforeach
            @endif
         </select>
      </div>
      <div class="col-md-2">
         <label for="inputGradCity" class="form-label">City</label>
         <select id="inputGradCity" name="inputGradCity" class="form-select city" data-live-search="true">
            <option value="">Select</option>
         </select>
      </div>
      <div class="col-md-1" id="addmore" @if(!empty($emp_details->mas_college_name) && ($emp_details->mas_college_name != null)) style="display:none" @else  @endif>
         <label for="addMore" class="form-label"></label>
         <button type="button" class="btn btn-primary add-mr" onclick="addMore()">Add More</button>
      </div>

      <div class="row g-3 masters" id="masters" @if(!empty($emp_details->mas_college_name) && ($emp_details->mas_college_name != null)) @else style="display:none" @endif >
         <div class="col-md-12">
            <h5>Masters Details</h5>
         </div>
         <div class="col-md-4">
            <label for="inputMasCollege" class="form-label">College Name</label>
            <input type="text" class="form-control" id="inputMasCollege" name="inputMCollege" value="{{$emp_details->mas_college_name??''}}">
         </div>
         <div class="col-md-2">
            <label for="inputMasDegreeName" class="form-label">Select Degree</label>
            <select id="inputMasDegree" name="inputMasDegree" class="form-select">
               <option selected value="">Choose...</option>
               <option value="M.tech" {{($emp_details->mas_degree == 'M.tech') ? 'selected' : ''}}>M.tech</option>
               <option value="MCA" {{($emp_details->mas_degree == 'MCA') ? 'selected' : ''}}>MCA</option>
            </select>
         </div>
         <div class="col-md-1">
            <label for="inputMasPassYear" class="form-label">Passing year</label>
            <select name="inputMasPassYear" class="form-select passyear" >
               <option value="">Select...</option>
               {{ $year = date('Y') }}
               @for ($i = 1990; $i <= $year; $i++) <option value="{{$i}}" {{($emp_details->mas_passing_year == $i) ? 'selected' : ''}}>{{$i}}</option>
                  @endfor
            </select>
         </div>
         <div class="col-md-2">
            <label for="inputMasState" class="form-label">State</label>
            <select id="inputMasState" name="inputMasState" class="form-select" data-live-search="true" onchange="getCityLIstFromStateId(this)">
               <option value="">Select</option>
               @if(!empty($states) && count($states) > 0)
               @foreach($states as $state)
               <option value="{{$state->id}}" {{($emp_details->mas_state == $state->id) ? 'selected' : ''}}>{{$state->state}}</option>
               @endforeach
               @endif
            </select>
         </div>
         <div class="col-md-2">
            <label for="inputMasCity" class="form-label">City</label>
            <select name="inputMasCity" class="form-select city" data-live-search="true">
               <option value="">Select</option>
            </select>
         </div>
         <div class="col-md-1 ">
            <label for="addMore" class="form-label"></label>
            <button type="button" class="btn btn-primary add-mr" onclick="remove();">Remove</button>
         </div>
      </div>

      <div class="col-12">
         <button type="submit" class="btn btn-primary">Save</button> 
         <button type="button" class="btn btn-primary" onclick="canceledit()">cancel</button> 
      </div>
   </form>
</div>
<!-- tabs for tables -->
<div class="nav nav-tabs nav-fill container mt-5" id="nav-tab" role="tablist">
   <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#Attendance" role="tab" aria-controls="nav-home" aria-selected="true">Attendance</a>
   <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#Lunch" role="tab" aria-controls="nav-profile" aria-selected="false">Lunch</a>
   <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#Breaks" role="tab" aria-controls="nav-contact" aria-selected="false">Breaks</a>
</div>

<div class="tab-content" id="nav-tabContent">
   <div class="tab-pane fade show active" id="Attendance" role="tabpanel" aria-labelledby="nav-home-tab">
      <div class="container">
         <h2>Attendance</h2>
         <table class="datatable table table-bordered table-striped table-responsive-stack" id="attendancetable">
            <thead class="thead-dark">
               <tr>
                  <th>Date</th>
                  <th>Login</th>
                  <th>Logout</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($signin as $timeshee)
               <tr>
                  <td>{{ $timeshee->login_date }}</td>
                  <td>{{ $timeshee->login_time}} &nbsp; {{ $timeshee->login_hour}}</td>
                  <td>{{ $timeshee->logout_time}} &nbsp; {{ $timeshee->logout_hour}}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>

   <div class="tab-pane fade" id="Lunch" role="tabpanel" aria-labelledby="nav-profile-tab">
      <div class="container">
         <h2>Lunch</h2>
         <table class="datatable table table-bordered table-striped table-responsive-stack" id="lunchtable">
            <thead class="thead-dark">
               <tr>
                  <th>Date</th>
                  <th>Lunch Start</th>
                  <th>Lunch End</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($lunch as $lunchs)
               <tr>
                  <td>{{ $lunchs->date }}</td>
                  <td>{{ $lunchs->lunch_end}} &nbsp; {{ $lunchs->start_hour}}</td>
                  <td>{{ $lunchs->lunch_end}} &nbsp; {{ $lunchs->end_hour}}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>

   <div class="tab-pane fade" id="Breaks" role="tabpanel" aria-labelledby="nav-contact-tab">
      <div class="container">
         <h2>Breaks</h2>
         <table class="datatable table table-bordered table-striped table-responsive-stack" id="breaktable">
            <thead class="thead-dark">
               <tr>
                  <th>Date</th>
                  <th>Break Start</th>
                  <th>Break End</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($breaks as $breaktime)
               <tr>
                  <td>{{ $breaktime->date }}</td>
                  <td>{{ $breaktime->break_start}} {{ $breaktime->start_hour}}</td>
                  <td>{{ $breaktime->break_end}} {{ $breaktime->end_hour}}</td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>

@endsection
