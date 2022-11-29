<!-- Header -->
<div class="header">
    <!-- Logo -->
    <div class="header-left" style="background:white">
        <a href="{{ url('home') }}" class="logo">
            <img id="logo_img" src="{{ url('img/logo.png') }}" height="52" width="196" alt="Logo">
        </a>
    </div>
    <!-- /Logo -->
    <i class="bi bi-balloon"></i>

    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <!-- Header Title -->
    <div class="page-title-box">

    </div>
    <!-- /Header Title -->

    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

    <!-- Header Menu -->
    <ul class="nav user-menu">

        <!--Announcements-->
        <li class="nav-item dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i> <span
                    class="badge rounded-pill">{{ Auth::user()->announcements ? Auth::user()->announcements->count() : 0 }}</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Announcements</span>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        @forelse(Auth::user()->announcements as $announcement)
                            <li class="notification-message">
                                <a href="{{ route('announcements.show', $announcement) }}">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">
                                                <img alt="" src="assets/img/profiles/avatar-09.jpg">
                                            </span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">{{ $announcement->posted_by }} </span>
                                            <span
                                                class="message-time">{{ $announcement->created_at->diffForHumans() }}</span>
                                            <span class="message-content"><a
                                                    href="{{ route('announcements.show', $announcement) }}">
                                                    {{ $announcement->title }} </a></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                        @endForElse
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
            <a href="{{route('announcements.index')}}">View all Announcements</a>
        </div>
            </div>
        </li>
        <!--/Announcements-->

        <!--Birthday Section-->
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <i class="fa fa-gift" style="font-size:25px"></i> <span
                        class="badge rounded-pill">{{ count($bd_d_employees) }}</span>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Birthdays Today</span>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            @forelse($bd_d_employees as $bd_d_employee)
                                <li class="notification-message">
                                    {{-- <a href="{{ route('employees.show', $bd_d_employee) }}"> --}}
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">
                                                <img alt="" src="{{ asset('/img/userAvartar.jpg') }}">
                                            </span>
                                        </div>
                                        <div class="list-body">
                                            <a href="#" data-toggle="modal" data-target="#birthday_message">
                                            <span>{{ $bd_d_employee->name }} </span>
                                            <span class="message-time">{{ $bd_d_employee->dob->format('M d') }}</span>
                                            <div class="clearfix"></div>
                                            <small class="text-dark">{{ "{$bd_d_employee->designation->name}, {$bd_d_employee->project->name}" }}</small>
                                        </div></a>
                                    </div>
                                    </a>
                                </li>
                            @empty
                            @endForElse
                        </ul>
                    </div>
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Upcoming {{ now()->format('F') }} Birthdays
                            ({{ $bd_m_employees->count() }})</span>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            @forelse($bd_m_employees as $bd_m_employee)
                                <li class="notification-message">
                                    {{-- <a href="{{ route('employees.show', $bd_m_employee) }}"> --}}
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">
                                                <img alt="" src="{{ asset('/img/userAvartar.jpg') }}">
                                            </span>
                                        </div>
                                        <div class="list-body">
                                            <span>{{ $bd_m_employee->name }} </span>
                                            <span class="message-time">{{ $bd_m_employee->dob->format('M d') }}</span>
                                            <div class="clearfix"></div>
                                            <small
                                                class="text-dark">{{ "{$bd_m_employee->designation->name}, {$bd_m_employee->project->name}" }}</small>
                                        </div>
                                    </div>
                                    </a>
                                </li>
                            @empty
                            @endForElse
                        </ul>
                    </div>
                </div>
            </li>
        <!--/Birthday-->
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img"><img src="{{ asset('light-theme/img/profiles/avatar-21.jpg') }}" alt="">
                    <span class="status online"></span></span>

                <span>{{ Auth::user()->name }}</span>
            </a>

            <div class="dropdown-menu">
                {{-- @if (isset(Auth::user()->employee))
                    <a class="dropdown-item" href="{{ route('employees.show', Auth::user()->employee) }}">My
                        Profile</a>
                @endif --}}
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="{{ route('changePasswordGet') }}">Change Password</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#">My Profile</a>
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Logout</a>
        </div>
    </div>
    <!-- /Mobile Menu -->

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
                <p>You are logged in as admin</p>
            </div>
        @endif

        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
    </div>
</div>
<!-- /Header -->
<!--Birthday Message Modal-->
<div id="birthday_message" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Wish {} a Happy Birthday!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    @csrf
                
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/Birthday Message Modal-->

