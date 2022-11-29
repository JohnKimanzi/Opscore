<!doctype html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Techno Brain">
        <meta name="keywords" content="Techno Brain, hrms, opscore">
        <meta name="robots" content="noindex, nofollow">

        <title>@if(isset($title)){{$title, 'ERP'}} - @endif Technobrain BPO </title>
		@include('layouts.partials.flash')
		@include('layouts.partials.common-style')

    </head>

<body>
    <!-- Main Wrapper -->
    <div class="main-wrapper">

        @include('layouts.partials.header')

        @include('layouts.partials.side-bar-min')

        @yield('content')


    </div>
    <!-- /Main Wrapper -->


    @include('layouts.partials.common-js')
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @auth
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown01">
                        @can('Manage Users')
                        <a class="dropdown-item" href="{{ route('users.index') }}">Users</a>
                        @endcan
                        @can('Manage Roles')
                        <a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>
                        @endcan
                        @can('Manage Permissions')
                        <a class="dropdown-item" href="{{ route('permissions.index') }}">Permissions</a>
                        @endcan
                    </div>
                </li>
            </ul>
            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
            {{-- <form class="form-inline my-2 my-lg-0">
	       <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
	       <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
	     </form> --}}
        </div>
    </nav>

    <main role="main" class="">

        <br />
        <br />
        <br />
        <br />
        <div class="container">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h5>@yield('content_header')</h5>
            </section>
            @include('inc.messages')
            @yield('content')
            {{-- temp to get form buttons off the floor --}}
            <br />
            <br />
        </div>

    </main><!-- /.container -->
    @stack('js')
    @yield('js')
    <!-- jQuery -->
    <script src="{{ asset('orange-theme/js/jquery-3.5.1.min.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="{{ asset('bootstrap/extensions/fixed-columns/bootstrap-table-fixed-columns.js') }}"></script>
</body>

</html>
