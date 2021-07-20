@extends('adminlayout')
  
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Add Employee</h5>
                <a href="{{route('add-employee')}}" class="stretched-link"></a>
            </div>
        </div>

        <div class="card view-emp" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">View Employees</h5>
                <a href="{{route('add-employee')}}" class="stretched-link"></a>
            </div>
        </div>
    </div>
</div>    

<!-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script type="text/javascript">
    function logout()
    {
        window.location.href = "{{route('logout')}}";
    }
    
    window.onunload = function() {
        logout();
    
}
</script> -->

@endsection
