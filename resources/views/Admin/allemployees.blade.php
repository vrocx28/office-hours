<!DOCTYPE html>
@extends('adminlayout')
@include('footer')
@section('content')
<div class="outer-sec">
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-6 col-md-6" style="text-align: left"> 
                <a href="{{route('admin')}}" class="btn btn-primary">&#8592; Back</a>
            </div>
            <div class="col-lg-6 col-md-6" style="text-align: right"> 
                <a href="{{('add-employee')}}" class="btn btn-primary">Add new Employee</a>
            </div>
            @foreach ($emp_data as $employee)
                <div class="col-lg-3 col-md-3">
                    <div class="card">
                        @if(!empty($employee->profile_pic))
                            <img src="{{url('')}}/{{$employee->profile_pic}}" class="card-img-top" alt="...">
                        @else
                            <img src="images/project_images/stock.jpg" class="card-img-top" alt="...">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{$employee->first_name}} &nbsp; {{$employee->last_name}}</h5>
                            <a href="{{route('view-employee-details')}}/{{$employee->id}}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
<!-- <label class="switch">
  <input type="checkbox" checked>
  <span class="slider round"></span>
</label> -->