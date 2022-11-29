<!-- Sidebar -->
<html>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li>
                    <a href="{{ route('home') }}"><i class="la la-dashboard"></i> <span> Dashboard</span> </a>

                </li>
                @can('Manage Teams')
                    <li class="submenu">
                        <a href="#"><i class="la la-users"></i> <span> Teams </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            @forelse($my_teams as $team)
                                <li><a href="{{ route('teams.show', $team) }}"><span>{{ $team->name }}</span></a></li>
                            @empty
                                No teams found!
                            @endforelse
                        </ul>
                    </li>

                @endcan

                @if (Auth::user()->hasRole(['Admin','BPO Director','Head of Operations','Operations Manager','Human Resource Manager','Human Resource Executive']))
                    <li class="menu-title">
                        <span>HR</span>
                    </li>
                    <li class="submenu">

                    <li><a href="{{ route('employees.index') }}"><i class="la la-users"></i> <span> Employees
                                Info</span></a></li>
                @endif

                <li><a href="{{ route('leaves.index') }}"> <i class="la la-sign-out"></i><span>Leaves</span> <span
                            class="badge badge-pill bg-primary float-right">{{ Auth::user()->employee->teams_i_can_manage->flatMap->leaves->where('status', 'new')->count() }}</span></a>
                </li>
                {{-- <li><a href="{{ route('attendance.index') }}"><i class="la la-table"></i><span>Attendance</span></a>
                </li> --}}
                @can('Manage Teams')
                <li class="submenu">
                    <a href="#"><i class="la la-table"></i> <span> Attendance </span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{ route('attendance.index') }}"><i class="la la-table"></i> <span> Attendance</span></a>
                        </li>
                        @can('Manage Users')
                        <li><a href="{{ route('all_attendance') }}"><i class="la la-users"></i> <span> Employees Stats</span></a>
                        </li>
                        @endcan
                        @can('Manage Teams')
                        <li class="submenu">
                            <a href="#"><i class="la la-bar-chart"></i> <span> Teams Attendance Stat </span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                @forelse($my_teams as $team)
                                    <li><a href="{{ route('admin_chart', $team->id) }}"><span>{{ $team->name }}</span></a></li>
                                @empty
                                    No records found!
                                @endforelse
                            </ul>
                        </li>
                    @endcan
                    </ul>
                </li>
            @endcan

                {{-- <li><a href="{{route('teams.show', Auth::user()->employee->team)}}"><i class="la la-user-friends"></i><span>My team</span></a></li> --}}

                {{-- @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('BPO Director') || Auth::user()->hasRole('Operations Manager') || Auth::user()->hasRole('Human Resouce Manager') || Auth::user()->hasRole('Human Resouce Executive')) --}}
                @can('Manage Teams')
                    <li class="submenu">
                        <a href="#"><i class="la la-receipt"></i> <span> Appraisal Reports </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('completed_appraisals') }}"><small><i
                                            class="la la-check-double"></i></small><span> Completed</span></a></li>
                            <li><a href="{{ route('pending_appraisals') }}"><small><i
                                            class="la la-pause"></i></small><span> Pending</span></a></li>
                        </ul>
                    </li>
                @endcan
                {{-- @if (now()->format('m') == 12) --}}
                <li><a href="{{ route('appraisals.index') }}"><i class="la la-level-up"></i><span>Appraisal</span></a>
                </li>
                {{-- @endif --}}
                @if (Auth::user()->hasRole('Operations Manager') ||
                    Auth::user()->hasRole('Assistant Operations Manager') ||
                    Auth::user()->hasRole('Business Development Executive') ||
                    Auth::user()->hasRole('Admin') ||
                    Auth::user()->hasRole('Administration Executive') ||
                    Auth::user()->hasRole('Administration Assistant') ||
                    Auth::user()->hasRole('BPO Director') ||
                    Auth::user()->hasRole('Business Development Manager'))
                    <li class="menu-title">
                        <span>Business Development</span>
                    </li>

                    <li>
                        <a href="{{ route('clients.index') }}"><i class="la la-user-tie"></i> <span>Clients</span></a>
                    </li>
                    <li>
                        <a href="{{ route('projects.index') }}"><i class="la la-briefcase"></i> <span>
                                Projects</span></a>
                    </li>
                @endif


                @if (Auth::user()->hasRole('Admin') ||
                    Auth::user()->hasRole('BPO Director') ||
                    Auth::user()->hasRole('Head of Operations') ||
                    Auth::user()->hasRole('Operations Manager') ||
                    Auth::user()->hasRole('Human Resouce Manager') ||
                    Auth::user()->hasRole('Human Resouce Executive') ||
                    Auth::user()->hasRole('Quality Lead'))
                    <li class="menu-title">
                        <span>Administration</span>
                    </li>

                    <li>
                        <a href="{{ route('users.index') }}"><i class="la la-user-plus"></i> <span>Users</span></a>
                    </li>
                    <li>
                        <a href="{{ route('roles.index') }}"><i class="la la-user-tag"></i> <span>Roles</span></a>
                    </li>
                    <li>
                        <a href="{{ route('permissions.index') }}"><i class="la la-tasks"></i>
                            <span>Permissions</span></a>
                    </li>

                    <li class="submenu">
                        <a href="#"><i class="la la-cogs"></i> <span> Settings </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="{{ route('departments.index') }}"><small><i
                                            class="la la-building"></i></small> <span> Departments</span></a></li>
                            <li><a href="{{ route('designation.index') }}"><small><i
                                            class="la la-briefcase"></i></small> <span> Designations</span></a></li>
                            <li>
                                <a href="{{ route('industry.index') }}"><small><i class="la la-industry"></i></small>
                                    <span> Industry</span></a>
                            </li>
                            <li>
                                <a href="{{ route('teams.index') }}"><small><i class="la la-users"></i></small> <span>
                                        Teams</span></a>
                            </li>
                            <li>
                                <a href="{{ route('channels.index') }}"><small><i
                                            class="la la-user-plus"></i></small><span> Channels</span> <span
                                        class="badge badge-pill bg-primary float-right">{{ \App\Models\Channel::all()->count() }}</span></a>
                            </li>
                            <li>
                                <a href="{{ route('service_type.index') }}"><small><i class="la la-bars"></i></small>
                                    <span>Service Types</span></a>
                            </li>

                            <li>
                                <a href="{{ route('project_type.index') }}"><small><i
                                            class="la la-project-diagram"></i></small> <span>Project Types</span></a>
                            </li>
                            <li>
                                <a href="{{ route('billing_frequency.index') }}"><small><i
                                            class="la la-sync"></i></small> <span>Billing Frequency</span></a>
                            </li>
                            <li>
                                <a href="{{ route('billing_type.index') }}"><small><i
                                            class="la la-money-check"></i></small> <span>Billing Type</span></a>
                            </li>

                            <li><a href="{{ route('benefit.index') }}"><small><i class="la la-money-check"></i></small>
                                    <span> Benefits</span></a>
                            </li>
                            <li><a href="{{ route('leave_type.index') }}"><small><i
                                            class="la la-money-check"></i></small> <span> Leave Types</span></a>
                            </li>
                            <li>
                                <a href="{{ route('currency.index') }}"><small><i
                                            class="la la-dollar-sign"></i></small> <span>Currency</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="la la-address-card"></i> <span> Profile </span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li><a href="profile.html"> Employee Profile </a></li>
                            <li><a href="client-profile.html"> Client Profile </a></li>
                        </ul>
                    </li>
                @endif
                <li class="menu-title">
                    <span>Extras</span>
                </li>
                <li><a href="{{ route('announcements.index') }}"> <i
                            class="la la-bell-o"></i><span>Announcements</span> <span
                            class="badge badge-pill bg-primary float-right">{{ \App\Models\Announcement::all()->count() }}</span></a>
                </li>
                {{-- <li><a href="{{ route('chats.index') }}"><small> <i
                                class="la la-comment"></i></small><span>Chats</span> <span
                            class="badge badge-pill bg-primary float-right"></span></a></li> --}}

                <li>
                    <a href="{{ route('policies.index') }}"><i class="la la-file-pdf"></i> <span>Policies</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>

</html>
<!-- /Sidebar -->
