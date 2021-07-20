@extends('adminlayout')
@section('content')
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
        <input type="email" class="form-control chkeml" id="inputPerEmail" name="inputPerEmail" onkeyup="checkemail(this)">
    </div>
    <div class="col-12">
        <label for="inputComEmail" class="form-label">Company Email</label>
        <input type="email" class="form-control" id="inputComEmail" name="inputComEmail">
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
    <h5>Education Details</h5>
    <div class = "after-add-more">
        <div class="row first_element">
            <div class="col-md-4">
                <label for="inputDegreetype" class="form-label">Degree Type</label>
                <select id="inputDegreetype" name="inputDegreetype[]" class="form-select" onchange="displayCourse(0)">
                    <option selected value="">Choose...</option>
                    <option value="Graduation">Graduation</option>
                    <option value="Masters">Masters</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputDegreeName" class="form-label">Select Degree</label>
                <select id="course" name="inputDegree[]" class="form-select" style="display:none">
                    <option selected value="">Choose...</option>
                    <option value="B.tech">B.tech</option>
                    <option value="BCA">BCA</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="inputPassYear" class="form-label">Passing year</label>
                <select id="inputPassYear" name="inputPassYear[]" class="form-select passyear" onload="genyear()">
                </select>
            </div>
            <div class="col-md-5">
                <label for="inputCollege" class="form-label">College Name</label>
                <input type="text" class="form-control" id="inputCollege" name="inputCollege[]">
            </div>
            <div class="col-md-3">
                <label for="inputState" class="form-label">State</label>
                    <select id="inputState" name="inputState[]" class="form-select" data-live-search="true" onchange="getCityLIstFromStateId(this)">
                        <option value="">Select</option>
                        @if(!empty($states) && count($states) > 0)
                        @foreach($states as $state)
                        <option value="{{$state->id}}">{{$state->state}}</option>
                        @endforeach
                        @endif
                    </select>
            </div>
            <div class="col-md-3">
                <label for="inputCity" class="form-label">City</label>
                <select name="inputCity[]" class="form-select city" data-live-search="true">
                    <option value="">Select</option>
                </select>
            </div>
            <div class="col-md-1 ">
                <label for="addMore" class="form-label"></label>
                <button type="button" class="btn btn-primary add-mr" onclick="addMore(this);">+</button>
            </div>
        </div>
    </div>
    <div class="col-12">
        <input type="submit" class="btn btn-primary" value="Add Employee">
    </div>
</form>
@endsection
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
    function randompass() {
        var length = 8,
            charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
            retVal = "";
        for (var i = 0, n = charset.length; i < length; ++i) {
            retVal += charset.charAt(Math.floor(Math.random() * n));
        }
        document.getElementById("inputPassword").value = retVal;
    }

    $(document).ready(function() {
        $('#AddEmp').validate({
            rules: {
                inputFname: 'required',
                inputLname: 'required',
                inputDesignation: 'required',
                inputEmployeeID: 'required',
                inputJDate: 'required',
                inputDepartment: 'required',
                inputStatus: 'required',
                inputDegreetype: 'required',
                course: 'required',
                inputMasters: 'required',
                inputPassYear: 'required',
                // inputEmail: {
                //     required: true,
                //     email: true,
                // },
                inputPassword: {
                    required: true,
                    minlength: 8,
                }
            },
            messages: {
                inputFname: 'This field is required',
                inputLname: 'This field is required',
                inputDesignation: 'This field is required',
                inputEmployeeID: 'This field is required',
                inputJDate: 'This field is required',
                inputDepartment: 'This field is required',
                inputStatus: 'This field is required',
                inputDegreetype: 'This field is required',
                course: 'This field is required',
                inputMasters: 'This field is required',
                inputPassYear: 'This field is required',
                // inputEmail: 'Enter a valid email',
                inputPassword: {
                    minlength: 'Password must be at least 8 characters long'
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });


   function addMore(obj) {
       $(obj).html('-');
       $(obj).attr("onclick", "remove(this)")
       var length = $('.after-add-more').length;
       $('.after-add-more').append('<div class="row first_element"><div class="col-md-4"><label for="inputDegreetype" class="form-label">Degree Type</label><select id="inputDegreetype'+length+'" name="inputDegreetype[]" class="form-select" onchange="displayCourse('+length+')"><option selected value="">Choose...</option><option value="Graduation">Graduation</option><option value="Masters">Masters</option></select></div><div class="col-md-4"><label for="inputDegreeName" class="form-label">Select Degree</label><select id="course'+length+'" name="inputDegree[]" class="form-select" style="display:none"><option selected value="">Choose...</option><option value="Graduation">B.tech</option><option value="Masters">BCA</option></select></div><div class="col-md-4"><label for="inputPassYear" class="form-label">Passing year</label><select id="inputPassYear" name="inputPassYear[]" class="form-select"></select></div><div class="col-md-5"><label for="inputCollege" class="form-label">College Name</label><input type="text" class="form-control" id="inputCollege" name="inputCollege[]"></div><div class="col-md-3"> <label for="inputState" class="form-label">State</label><select id="inputState'+length+'" name="inputState[]" class="form-select" data-live-search="true" onchange="getCityLIstFromStateId(this)"><option value="">Select</option>@if(!empty($states) && count($states) > 0)@foreach($states as $state)<option value="{{$state->id}}">{{$state->state}}</option> @endforeach @endif </select></div><div class="col-md-3"><label for="inputCity" class="form-label">City</label><select name="inputCity[]" class="form-select city" data-live-search="true"><option value="">Select</option></select></div><div class="col-md-1"><label for="addMore" class="form-label"></label><button type="button" class="btn btn-primary add-mr" onclick="remove(this);">-</button></div></div>');
    }

    function remove(obj) {
        $('.add-mr').html('+')
        $('.add-mr').attr("onclick", "addMore(this)")
        $(obj).parent().parent().remove()
    }

    function displayCourse(length) {
            if(length==0){
                length='';
            }
                if ($("#inputDegreetype"+length).val() == "Graduation") {
                    $("#course"+length).show();
                $("#course"+length).html(' <option selected value="">Choose...</option><option value="b_tech">B.tech</option><option value="bca">BCA</option>');
            } else if ($("#inputDegreetype"+length).val() == "Masters") {
                    $("#course"+length).show();
                $("#course"+length).html(' <option selected value="">Choose...</option><option value="m_tech">M.tech</option><option value="mca">MCA</option>');
            } else {
                    $("#course"+length).hide();
                $("#course"+length).html('');
            }           
    }
    
    function getCityLIstFromStateId(obj){
        var state_id = $(obj).val();
        var data = {state_id : state_id};
        $.ajax({
            type: "GET",
            url: "{{action('AdminController@getCityList')}}",
            data: data,
            cache: false,
            success: function(response) {
                $(obj).parent().next().find('.city').html(response.cities_list);
            }
       });
   }

   function checkemail(obj){
            var peremail = $(obj).val();
            var token='{{csrf_token()}}';
            $.ajax({
            url: '{{route("email-post")}}',
            method: "POST",
            dataType: "json",
            data:{peremail:peremail, '_token':token},
            cache: false, 
            success: function(response) {
              if(response.status == '500'){
                $(obj).parent().next().find('.chkeml').html('<label id="error-msg" style="color:red">Already Exist</label>');
               }else{
               }
            }
        });
    }
    
    function genyear() {
            //Reference the DropDownList.
            var inputPassYear = document.getElementById("inputPassYear");

            //Determine the Current Year.
            var currentYear = (new Date()).getFullYear();

            //Loop and add the Year values to DropDownList.
            for (var i = 1990; i <= currentYear; i++) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;
                inputPassYear.appendChild(option);
            }
        }
</script>