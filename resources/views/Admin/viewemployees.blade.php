<!DOCTYPE html>
@extends('adminlayout')
@include('footer')
@section('content')
<div class="outer-sec">
<div class="container mt-5">
    <div class="row">
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
                        <a href="{{route('view-employee-delatils')}}/{{$employee->id}}" class="stretched-link"></a>
                    </div>
                </div>
            </div>    
        @endforeach
    </div>
</div> 
</div>   
@endsection