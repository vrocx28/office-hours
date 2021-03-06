<!DOCTYPE html>
<html>
<head>
    <title>Office Hours</title>
    @include('header')
</head>
<body class="body">
    
<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Office-Hours</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                @if(Auth::guard('emp')->user())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('emplogout') }}">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endif
            </ul>
  
        </div>
    </div>
</nav>
  
@yield('content')
     
</body>
</html>

<!-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script>
 $(window).on('beforeunload', function(){
var c=confirm("Sure you want to logout?");
if(c){
  return true;
}
else
return false;
});
</script> -->
