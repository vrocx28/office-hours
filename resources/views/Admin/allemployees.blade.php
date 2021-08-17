<!DOCTYPE html>
@extends('adminlayout')
@include('footer')
@section('content')
<div class="outer-sec">
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-6 col-md-6" style="text-align: left">
                <a href="{{route('admin')}}" class="btn btn-primary">&#8592; Back</a>
            </div>
            <div class="col-lg-6 col-md-6" style="text-align: right">
                <a href="{{('add-employee')}}" class="btn btn-primary">Add new Employee</a>
            </div>
            @foreach ($emp_data as $employee)
                <div class="bs-example col-lg-3 col-md-3">
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-sm-5" style="background: #868e96;">
                                @if(!empty($employee->profile_pic))
                                    <img src="{{url('')}}/{{$employee->profile_pic}}" class="card-img-top h-100" alt="...">
                                @else
                                    <img src="images/project_images/stock.jpg" class="card-img-top h-100" alt="...">
                                @endif
                            </div>
                            <div class="col-sm-7">
                                <div class="card-body">
                                <a href="{{route('view-employee-details')}}/{{$employee->id}}"><i class="fa fa-gear" style="font-size:24px"></i></a>
                                    <h5 class="card-title">{{$employee->first_name}} {{$employee->last_name}}</h5>
                                    <p class="card-text"><b>Stauts:</b>@if($employee->status == '1') Active @else Inactive @endif </p>
                                    <a href="{{route('downloadExcel')}}/{{'xlsx'}}/{{$employee->id}}" class="btn btn-primary">Export</a>
                                    <label class="switch">
                                        <input data-id="{{$employee->id}}" class="toggle-class" type="checkbox" {{ $employee->status ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection