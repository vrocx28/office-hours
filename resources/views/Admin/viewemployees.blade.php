@extends('adminlayout')
@section('content')

<div class="container mt-5">
    <div class="row">
        @foreach ($emp_data as $employee)
            <div class="col-lg-3 col-md-3">
                <div class="card emp-badge">
                    @if(!empty($employee->profile_pic))
                        <img src="{{url('')}}/{{$employee->profile_pic}}" class="card-img-top" alt="..." width="100%">
                    @else
                        <img src="images/project_images/stock.jpg" class="card-img-top" alt="..."> 
                    @endif
                    <div class="card-body badge-body">
                        <h5 class="card-title">{{ $employee->first_name }}</h5>
                        <a href="{{route('view-employee-delatils')}}/{{$employee->id}}" class="stretched-link"></a>
                    </div>
                </div>
            </div>    
        @endforeach
    </div>
</div>    
@endsection