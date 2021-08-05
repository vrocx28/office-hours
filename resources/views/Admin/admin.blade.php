<!DOCTYPE html>
@extends('adminlayout')
@include('footer')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-3 col-md-3">
            <div class="card emp-badge">
                <img src="images/project_images/Add_Emp.jpg" class="card-img-top" alt="..." width="100%">
                <div class="card-body badge-body">
                    <h5 class="card-title">Add Employee</h5>
                    <a href="{{route('add-employee')}}" class="stretched-link"></a>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3">
            <div class="card emp-badge">
                <img src="images/project_images/View_Emp.jpg" class="card-img-top" alt="..." width="100%">
                <div class="card-body badge-body">
                    <h5 class="card-title">View Employees</h5>
                    <a href="{{route('all-employees')}}" class="stretched-link"></a>
                </div>
            </div>
        </div>
    </div>
</div>    

<!-- <script type="text/javascript">
window.onunload = function() {
        logout();
    
}
    function logout()
    {
        window.location.href = "{{route('logout')}}";
    }
</script> -->

@endsection