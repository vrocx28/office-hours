<!DOCTYPE html>
@extends('userlayout')
@include('footer')
@section('content')

<div class="container mt-3">
   <div class="row">
      <div class="col-md-6" style="text-align: left">
      <a href="{{route('dashboard')}}" class="btn btn-primary">&#8592; Back</a>
      </div>
      <div class="col-md-6" style="text-align: right">
         <button type="button" class="btn btn-primary" id="editprofilebutton" onclick="editprofile();">Edit Details</button>
      </div>
   </div>
</div>

<div class="container mt-3 empedit">

   <form class="edit-forms" id="empform" action="{{ route('edit-employee-post') }}" autocomplete="off" enctype="multipart/form-data" method="post">
      <div class="row g-2 dd">
         <div class="col-md-3">
            @if(!empty($emp_details->profile_pic))
            <img src="{{url('')}}/{{$emp_details->profile_pic}}" alt="..." style="width:180px">
            @else
            <img src="{{url('')}}/images/project_images/stock.jpg" alt="..." style="width:180px">
            @endif
         </div>
         @csrf
         <input type="hidden" class="form-control activate" name="record_id" value="{{$emp_details->id??''}}">
         <div class="col-md-3">
            <label for="inputFname" class="form-label">First Name</label>
            <input type="text" class="form-control activate" id="inputFname" name="inputFname" value="{{$emp_details->first_name??''}}">
         </div>
         <div class="col-md-3">
            <label for="inputLname" class="form-label">Last Name</label>
            <input type="text" class="form-control activate" id="inputLname" name="inputLname" value="{{$emp_details->last_name??''}}">
         </div>
         <div class="col-md-3">
            <label for="inputPhone" class="form-label">Phone No.</label>
            <input type="tel" class="form-control activate" name="inputPhone" value="{{$emp_details->phone??''}}">
         </div>
      </div>
      <div class="row g-2">
         <div class="col-md-5">
            <label for="inputPerEmail" class="form-label">Personal Email</label>
            <input type="email" class="form-control" name="inputPerEmail" value="{{$emp_details->personal_email??''}}">
            <label id="error-msg" class="chkeml" style="color:red"></label>
         </div>
         <div class="col-md-5">
            <label for="inputComEmail" class="form-label">Company Email</label>
            <input type="email" class="form-control" name="inputComEmail" value="{{$emp_details->email??''}}">
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
            <label for="inputPassword" class="form-label">Password</label>
            <input type="password " class="form-control activate" id="inputPassword" name="inputPassword">
         </div>
         <div class="col-md-2">
            <label for="inputDesignation" class="form-label">Designation</label>
            <input type="text" class="form-control" id="inputDesignation" name="inputDesignation" value="{{$emp_details->designation??''}}">
         </div>
         <div class="col-md-2">
            <label for="inputEmployeeID" class="form-label">Employee ID</label>
            <input type="text" class="form-control" id="inputEmployeeID" name="inputEmployeeID" value="{{$emp_details->employee_id??''}}">
         </div>
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
      </div>

      <!-- graduation details -->
      <div class="row g-2">
         <div class="col-md-12">
            <h5>Graduation Details</h5>
         </div>
         <div class="col-md-4">
            <label for="inputGradCollege" class="form-label">College Name</label>
            <input type="text" class="form-control" name="inputGradCollege" value="{{$emp_details->grad_college_name??''}}">
         </div>
         <div class="col-md-2">
            <label for="inputGDegreeName" class="form-label">Select Degree</label>
            <select id="inputGradDegree" name="inputGradDegree" class="form-select">
               <option selected value="">Choose...</option>
               <option value='B.tech' {{($emp_details->grad_degree == 'B.tech') ? 'selected' : ''}}>B.tech</option>
               <option value='BCA' {{($emp_details->grad_degree == 'BCA') ? 'selected' : ''}}>BCA</option>
            </select>
         </div>
         <div class="col-md-2">
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
               @foreach($gradcity as $gcity)
               <option value="{{$gcity->id}}" {{($emp_details->grad_city == $gcity->id) ? 'selected' : ''}}>{{$gcity->city}}</option>
               @endforeach
            </select>
         </div>
      </div>

      <!-- masters deatails -->
      <div class="row g-2 masters" id="masters" @if(!empty($emp_details->mas_college_name) && ($emp_details->mas_college_name != null)) @else style="display:none" @endif >
         <div class="col-md-12">
            <h5>Masters Details</h5>
         </div>
         <div class="col-md-4">
            <label for="inputMasCollege" class="form-label">College Name</label>
            <input type="text" class="form-control" name="inputMasCollege" value="{{$emp_details->mas_college_name??''}}">
         </div>
         <div class="col-md-2">
            <label for="inputMasDegreeName" class="form-label">Select Degree</label>
            <select id="inputMasDegree" name="inputMasDegree" class="form-select">
               <option selected value="">Choose...</option>
               <option value="M.tech" {{($emp_details->mas_degree == 'M.tech') ? 'selected' : ''}}>M.tech</option>
               <option value="MCA" {{($emp_details->mas_degree == 'MCA') ? 'selected' : ''}}>MCA</option>
            </select>
         </div>
         <div class="col-md-2">
            <label for="inputMasPassYear" class="form-label">Passing year</label>
            <select name="inputMasPassYear" class="form-select passyear">
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
               @foreach($mascity as $mcity)
               <option value="{{$mcity->id}}" {{($emp_details->mas_city == $mcity->id) ? 'selected' : ''}}>{{$mcity->city}}</option>
               @endforeach
            </select>
         </div>
      </div>

      <div class="row g-2">
         <div class="col-md-12">
            <button type="submit" class="btn btn-primary add-btn">Save</button>
            <button type="button" class="btn btn-primary add-btn" onclick="canceledit()">cancel</button>
         </div>
      </div>
   </form>
</div>
@endsection