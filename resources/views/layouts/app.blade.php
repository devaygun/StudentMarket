<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title') {{ config('app.name', 'Student Market') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <style>
        .space-right {
            margin-right: 15px;
        }
        .nav-font {
            font-size: 18px;
        }
        .avatar {
            margin-right: 5px;
            border: solid dimgray 2px;
            height: 40px;
            width: 40px;
        }
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href=""></a></li>
                        <li><a href="" data-toggle="modal" data-target="#sellModal"><i class="fa fa-plus" aria-hidden="true"></i> Sell Item</a></li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    @php $user = \Illuminate\Support\Facades\Auth::user(); @endphp
                                    <span class="nav-font">
                                        <img src="{{$user->getProfilePicture()}}" class="img-circle avatar" alt="">

                                        {{ "$user->first_name $user->last_name"}}
                                        <span class="caret"></span>
                                    </span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/profile">Profile</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @guest

        @else
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <i class="fa fa-times" aria-hidden="true"></i> {{ $error }}<br>
                @endforeach
            </div>
        @endif

        @if (\Illuminate\Support\Facades\Session::has('success'))
            <div class="alert alert-success">
                <i class="fa fa-check" aria-hidden="true"></i> {{ session('success') }}
            </div>
        @endif
        <div class="container">
            <div class="col-sm-8 col-sm-offset-2" style="margin-bottom: 20px;">
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control space-right" placeholder="I'm looking for..." style="width: 300px;">
                    </div>
                    <div class="form-group space-right">
                        in
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control space-right" placeholder="Location or Postcode">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        @endguest
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Modals -->
    @include('modals.add_item')
</body>
</html>
