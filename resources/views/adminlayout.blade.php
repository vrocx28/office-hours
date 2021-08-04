<!DOCTYPE html>
<html>
<head>
    <title>Office Hours</title>
    @include('header')
</head>
<body class="body">
    
<nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin') }}">Office-Hours</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
   
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            @if(Auth::guard('admin')->user())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('adminlogin') }}">Login</a>
                    </li>
                @endif
            </ul>
  
        </div>
    </div>
</nav>
  
@yield('content')
@include('footer')
</body>
</html>