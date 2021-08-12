<!DOCTYPE html>
@extends('userlayout')
@include('footer')
@section('content')

<div class="container mt-3">
   <div class="row">
      <div class="col-md-6" style="text-align: right">
         <button type="button" id="startbreak" class="btn btn-primary" onclick="takebreak();">Take a Break</button>
         <button type="button" id="endbreak" class="btn btn-primary" style="display:none" onclick="endbreak();">End Break</button>
      </div>
      <div class="col-md-4" style="text-align: left">
         <button type="button" id="startlunch" class="btn btn-primary" onclick="startlunch();">Lunch Break</button>
         <button type="button" id="endlunch" class="btn btn-primary" style="display:none" onclick="endlunch();">End Lunch</button>
      </div>
   </div>
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
                  <td>{{ $timeshee->login_time}} {{ $timeshee->login_hour}}</td>
                  <td>{{ $timeshee->logout_time}} {{ $timeshee->logout_hour}}</td>
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
                  <td>{{ $lunchs->lunch_end}} {{ $lunchs->start_hour}}</td>
                  <td>{{ $lunchs->lunch_end}} {{ $lunchs->end_hour}}</td>
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