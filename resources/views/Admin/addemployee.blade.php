<!DOCTYPE html>
@extends('adminlayout')
@section('content')
<div class="container mt-5">
    <form class="row g-3 form-container" action="{{ route('employee-post') }}" id="AddEmp" autocomplete="off" enctype="multipart/form-data" method="post">

        <h2>Add Employee</h2>
        @csrf
        <div class="col-md-6">
            <label for="inputFname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="inputFname" name="inputFname">
        </div>
        <div class="col-md-6">
            <label for="inputLname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="inputLname" name="inputLname">
        </div>
        <div class="col-12">
            <label for="inputPerEmail" class="form-label">Personal Email</label>
            <input type="email" class="form-control" name="inputPerEmail" onkeyup="checkperemail(this)">
            <label id="error-msg" class="chkeml" style="color:red"></label>
        </div>
        <div class="col-12">
            <label for="inputComEmail" class="form-label">Company Email</label>
            <input type="email" class="form-control" name="inputComEmail" onkeyup="checkemail(this)">
            <label id="error-msg" class="eml" style="color:red"></label>
        </div>
        <div class="col-md-6">
            <label for="inputPassword" class="form-label">Password</label>
            <input type="text" class="form-control" id="inputPassword" name="inputPassword" value="">
        </div>
        <div class="col-md-3">
            <label for="inputConfPassword" class="form-label">Generate Password</label>
            <button type="button" class="btn btn-primary" onclick="randompass();">Generate</button>
        </div>
        <div class="col-md-3">
            <label for="inputStatus" class="form-label">Status</label>
            <select id="inputStatus" name="inputStatus" class="form-select">
                <option selected value="">Choose...</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <!-- <div class="col-md-6">
                    <label for="inputConfPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="inputConfPassword" name="inputConfPassword">
                </div> -->
        <div class="col-md-6">
            <label for="inputDesignation" class="form-label">Designation</label>
            <input type="text" class="form-control" id="inputDesignation" name="inputDesignation">
        </div>
        <div class="col-md-6">
            <label for="inputEmployeeID" class="form-label">Employee ID</label>
            <input type="text" class="form-control" id="inputEmployeeID" name="inputEmployeeID">
        </div>
        <div class="col-md-6">
            <label for="inputProfilepic" class="form-label">Upload pic</label>
            <input type="file" class="form-control" id="inputProfilepic" name="inputProfilepic" accept="image/*">
        </div>
        <div class="col-md-3">
            <label for="inputDepartment" class="form-label">Department</label>
            <select id="inputDepartment" name="inputDepartment" class="form-select">
                <option selected value="">Choose...</option>
                <option value='Design'>Design</option>
                <option value='Develpoment'>Develpoment</option>
                <option value='Management'>Management</option>
                <option value='Marketing'>Marketing</option>
            </select>
        </div>
        <div class="col-md-3">
            <label for="inputEmployeeID" class="form-label">Joining Date</label>
            <input type="date" class="form-control" id="inputJDate" name="inputJDate">
        </div>

        <div class="col-md-12">
            <h5>Graduation Details</h5>
        </div>
        <!-- <div class="col-md-4">
            <label for="inputDegreetype" class="form-label">Degree Type</label>
            <select id="inputDegreetype" name="inputDegreetype[]" class="form-select unique-value" onchange="displayCourse(0)">
                <option selected value="">Choose...</option>
                <option value="Graduation">Graduation</option>
                <option value="Masters">Masters</option>
            </select>
        </div> -->
        <div class="col-md-6">
            <label for="inputGradCollege" class="form-label">College Name</label>
            <input type="text" class="form-control" id="inputGradCollege" name="inputGradCollege">
        </div>
        <div class="col-md-4">
            <label for="inputGDegreeName" class="form-label">Select Degree</label>
            <select id="inputGradDegree" name="inputGradDegree" class="form-select">
                <option selected value="">Choose...</option>
                <option value="B.tech">B.tech</option>
                <option value="BCA">BCA</option>
            </select>
        </div>
        <div class="col-md-2">
            <label for="inputGradPassYear" class="form-label">Passing year</label>
            <select id="inputGradPassYear" name="inputGradPassYear" class="form-select passyear">
                <option value="">Select...</option>
                {{ $year = date('Y') }}
                @for ($i = 1990; $i <= $year; $i++) <option value="{{$i}}">{{$i}}</option>
                    @endfor
            </select>
        </div>
        <div class="col-md-3">
            <label for="inputGradState" class="form-label">State</label>
            <select id="inputGradState" name="inputGradState" class="form-select" data-live-search="true" onchange="getCityLIstFromStateId(this)">
                <option value="">Select</option>
                @if(!empty($states) && count($states) > 0)
                @foreach($states as $state)
                <option value="{{$state->id}}">{{$state->state}}</option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-3">
            <label for="inputGradCity" class="form-label">City</label>
            <select id="inputGradCity" name="inputGradCity" class="form-select city" data-live-search="true">
                <option value="">Select</option>
            </select>
        </div>
        <div class="col-md-1 ">
            <label for="addMore" class="form-label"></label>
            <button type="button" class="btn btn-primary add-mr" id="addmore" onclick="addMore();">Add More</button>
        </div>

        <div class="row g-3 masters" id="masters" style="display:none">
            <div class="col-md-12">
                <h5>Masters Details</h5>
            </div>
            <!-- <div class="col-md-4">
                <label for="inputDegreetype" class="form-label">Degree Type</label>
                <select id="inputDegreetype" name="inputDegreetype[]" class="form-select unique-value" onchange="displayCourse(0)">
                    <option selected value="">Choose...</option>
                    <option value="Graduation">Graduation</option>
                    <option value="Masters">Masters</option>
                </select>
            </div> -->
            <div class="col-md-6">
                <label for="inputMasCollege" class="form-label">College Name</label>
                <input type="text" class="form-control" id="inputMasCollege" name="inputMasCollege">
            </div>
            <div class="col-md-4">
                <label for="inputMasDegreeName" class="form-label">Select Degree</label>
                <select id="inputMasDegree" name="inputMasDegree" class="form-select">
                    <option selected value="">Choose...</option>
                    <option value="M.tech">M.tech</option>
                    <option value="MCA">MCA</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="inputMasPassYear" class="form-label">Passing year</label>
                <select name="inputMasPassYear" class="form-select passyear">
                    <option value="">Select...</option>
                    {{ $year = date('Y') }}
                    @for ($i = 1990; $i <= $year; $i++) <option value="{{$i}}">{{$i}}</option>
                        @endfor
                </select>
            </div>
            <div class="col-md-3">
                <label for="inputMasState" class="form-label">State</label>
                <select id="inputMasState" name="inputMasState" class="form-select" data-live-search="true" onchange="getCityLIstFromStateId(this)">
                    <option value="">Select</option>
                    @if(!empty($states) && count($states) > 0)
                    @foreach($states as $state)
                    <option value="{{$state->id}}">{{$state->state}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="col-md-3">
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
            <input type="submit" class="btn btn-primary" value="Add Employee">
        </div>
    </form>
</div>
@endsection
