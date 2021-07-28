<!DOCTYPE html>
@extends('adminlayout')
@include('footer')
@section('content')

<table border = 1>
      <caption>Breaks</caption>
         <tr>
            <td>Date</td>
            <td>Start</td>
            <td>End</td>
         </tr>
         @foreach ($breaks as $timeout)
         <tr>
            <td>{{ $timeout->date }}</td>
            <td>{{ $timeout->break_start}} &nbsp; {{ $timeout->start_hour}}</td>
            <td>{{ $timeout->break_end}} &nbsp; {{ $timeout->end_hour}}</td>
         </tr>
         @endforeach
      </table>
      <br><br>
<!-- <label class="switch">
  <input type="checkbox" checked>
  <span class="slider round"></span>
</label> -->

@endsection
