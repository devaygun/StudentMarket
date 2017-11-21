<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <style>
        .space-right {
            margin-right: 15px;
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
                        &nbsp;<li><a href=""></a></li>
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
                                    {{ Auth::user()->first_name . " " . Auth::user()->last_name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="/profile">My Profile</a></li>
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
    <div id="sellModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sell Item</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/items/create">
                        {{ csrf_field() }} {{-- Needed within all forms to prevent CSRF attacks --}}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" value="" name="name" minlength="2" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" value="" name="description" minlength="2" maxlength="255" required>
                        </div>
                        <div class="form-group">
                            <label for="select" >Select a category</label>
                            <select class="form-control" id="select">
                                {{--@foreach ($categories as $category)--}}
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                {{--@endforeach--}}
                            </select>
                        </div>
                        <div class="form-group" style="display: inline-block">
                            <label class="radio-inline"><input onchange="checkedSellType()" type="radio" name="sellType" checked>Sell</label>
                        </div>
                        <div class="form-group" style="display: inline-block">
                            <label class="radio-inline"><input onchange="checkedSwapType()" type="radio" name="sellType">Swap</label>
                        </div>
                        <div class="form-group" style="display: inline-block">
                            <label class="radio-inline"><input onchange="checkedPEType()" type="radio" name="sellType">Part-Exchange</label>
                        </div>

                        <div id="modalCreatePriceForm" class="form-group" style="display: none">
                            <label for="price">Price (£)</label>
                            <input type="number" class="form-control" id="modalCreatePrice" min="1" max="100000" value="" name="price">
                        </div>
                        <div id="modalCreateSwapForm" class="form-group" style="display: none">
                            <label for="swap">Swap for</label>
                            <input type="text" class="form-control" id="modalCreateSwap" min="1" max="255" value="" name="swap">
                        </div>
                        <div id="modalCreatePartExchangeForm" class="form-group">
                            <label for="part-exchange">Part-Exchange for</label>
                            <input type="text" class="form-control" id="modalCreatePartExchange" min="1" max="255" value="" name="part-exchange" required>
                        </div>

                        <button type="submit" class="btn btn-success">Add item</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" style="float: left;"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                </div>

                <!-- Script -->
                <script>

                    function checkedSellType() {
                        document.getElementById('modalCreatePriceForm').style.display = "block";
                        document.getElementById('modalCreatePrice').required = true;
                        document.getElementById('modalCreateSwap').value = "";
                        document.getElementById('modalCreateSwap').required = false;
                        document.getElementById('modalCreateSwapForm').style.display = "none";
                        document.getElementById('modalCreatePartExchange').value = "";
                        document.getElementById('modalCreatePartExchange').required = false;
                        document.getElementById('modalCreatePartExchangeForm').style.display = "none";
                    }
                    function checkedSwapType() {
                        document.getElementById('modalCreatePrice').value = "";
                        document.getElementById('modalCreatePrice').required = false;
                        document.getElementById('modalCreatePriceForm').style.display = "none";
                        document.getElementById('modalCreateSwap').value = "";
                        document.getElementById('modalCreateSwap').required = true;
                        document.getElementById('modalCreateSwapForm').style.display = "block";
                        document.getElementById('modalCreatePartExchange').value = "";
                        document.getElementById('modalCreatePartExchange').required = false;
                        document.getElementById('modalCreatePartExchangeForm').style.display = "none";
                    }
                    function checkedPEType() {
                        document.getElementById('modalCreatePriceForm').style.display = "block";
                        document.getElementById('modalCreatePrice').required = true;
                        document.getElementById('modalCreateSwap').value = "";
                        document.getElementById('modalCreateSwap').required = false;
                        document.getElementById('modalCreateSwapForm').style.display = "none";
                        document.getElementById('modalCreatePartExchange').value = "";
                        document.getElementById('modalCreatePartExchange').required = true;
                        document.getElementById('modalCreatePartExchangeForm').style.display = "block";
                    }
                </script>
            </div>
        </div>
    </div>
</body>
</html>
