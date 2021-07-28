<!DOCTYPE html>
@extends('userlayout')
@include('footer')
@section('content')
<h3 style="text-align: center">keep this window open and continue your work</h3>
<div class="container">
    <div class="row">
        <div class="col-md-12"style="text-align: center">
            <button type="button" id= "startbreak" class="btn btn-primary" onclick="takebreak();">Take a Break</button>
            <button type="button" id= "endbreak" class="btn btn-primary" style="display:none" onclick="endbreak();">End Break</button>
            <button type="button" id= "startlunch" class="btn btn-primary"  onclick="startlunch();">Lunch Break</button>
            <button type="button" id= "endlunch" class="btn btn-primary" style="display:none" onclick="endlunch();" >End Lunch</button>
        </div>
    </div>
</div>
@endsection
<script>
$(document).ready(function() {
    $.ajax({
        url: '{{route("change-break-button")}}',
        method: "GET",
        success: function(response) {
            if (response.status == '500') {
                $("#startbreak").show();
                $("#endbreak").hide();
            }else if(response.status == '200'){
                $("#startbreak").hide();
                $("#endbreak").show();
            }
        }
    });
});

function takebreak(){
    $("#startbreak").hide();
    $("#endbreak").show();
    $.ajax({
        type: "GET",
        url: "{{action('UserController@takeabreak')}}",
    });
}

function endbreak(){
    $("#startbreak").show();
    $("#endbreak").hide();
    $.ajax({
        type: "GET",
        url: "{{action('UserController@endbreak')}}",
    });
}

$(document).ready(function() {
    $.ajax({
        url: '{{route("change-lunch-button")}}',
        method: "GET",
        success: function(response) {
            if (response.status == '500') {
                $("#startlunch").show();
                $("#endbreak").hide();
            }else if(response.status == '200'){
                $("#startlunch").hide();
                $("#endlunch").show();
            }
        }
    });
});

function startlunch(){
    $("#startlunch").hide();
    $("#endlunch").show();
    $.ajax({
        type: "GET",
        url: "{{action('UserController@startlunch')}}",
    });
}

function endlunch(){
    $("#startlunch").show();
    $("#endlunch").hide();
    $.ajax({
        type: "GET",
        url: "{{action('UserController@endlunch')}}",
    });
}
</script>