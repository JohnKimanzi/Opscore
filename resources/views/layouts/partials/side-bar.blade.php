<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>

                @if(\Illuminate\Support\Facades\Auth::user()->hasRole('Software Developer'))
                <li >
                    Hello
                    <a href="{{route('home')}}"><i class="la la-dashboard"></i> <span> Dashboard</span> </a>

                </li>
                @endif

                <li class="menu-title">
                    <span>HR</span>
                </li>
                <li class="submenu">
                    <a href="" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('employees.index')}}">All Employees</a></li>
                        <li><a href="holidays.html">Holidays</a></li>

                        <li><a href="{{route('leaves.index')}}">Leaves (Admin) <span class="badge badge-pill bg-primary float-right">{{@count($allLeaves)}}</span></a></li>

                        <li><a href="attendance.html">Attendance (Admin)</a></li>
                        <li><a href="departments.html">Departments</a></li>
                        <li><a href="designations.html">Designations</a></li>
                        <li><a href="timesheet.html">Timesheet</a></li>
                        <li><a href="shift-scheduling.html">Shift & Schedule</a></li>
                    </ul>
                </li>
                <li><a href="promotion.html"><i class="la la-bullhorn"></i> <span>Promotion</span></a></li>
                <li><a href="resignation.html"><i class="la la-external-link-square"></i> <span>Resignation</span></a></li>
                <li><a href="termination.html"><i class="la la-times-circle"></i> <span>Termination</span></a></li>
                <li class="submenu">
                    <a href="#"><i class="la la-money"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="salary.html"> Employee Salary </a></li>
                        <li><a href="salary-view.html"> Payslip </a></li>
                        <li><a href="payroll-items.html"> Payroll Items </a></li>
                    </ul>
                </li>
                <li>
                    <a href="policies.html"><i class="la la-file-pdf-o"></i> <span>Policies</span></a>
                </li>
                <li class="menu-title">
                    <span>Business Development</span>
                </li>
                <li>
                    <a href="clients.html"><i class="la la-users"></i> <span>Clients</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-rocket"></i> <span> Projects</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="projects.html">Projects</a></li>
                        <li><a href="tasks.html">Tasks</a></li>
                        <li><a href="task-board.html">Task Board</a></li>
                    </ul>
                </li>
                <li>
                    <a href="leads.html"><i class="la la-user-secret"></i> <span>Leads</span></a>
                </li>


                <li class="submenu">
                    <a href="#"><i class="la la-files-o"></i> <span> Sales </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="estimates.html">Estimates</a></li>
                        <li><a href="invoices.html">Invoices</a></li>
                        <li><a href="payments.html">Payments</a></li>
                        <li><a href="expenses.html">Expenses</a></li>
                        <li><a href="provident-fund.html">Provident Fund</a></li>
                        <li><a href="taxes.html">Taxes</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-files-o"></i> <span> Accounting </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="categories.html">Categories</a></li>
                        <li><a href="budgets.html">Budgets</a></li>
                        <li><a href="budget-expenses.html">Budget Expenses</a></li>
                        <li><a href="budget-revenues.html">Budget Revenues</a></li>
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="la la-pie-chart"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="expense-reports.html"> Expense Report </a></li>
                        <li><a href="invoice-reports.html"> Invoice Report </a></li>
                        <li><a href="payments-reports.html"> Payments Report </a></li>
                        <li><a href="project-reports.html"> Project Report </a></li>
                        <li><a href="task-reports.html"> Task Report </a></li>
                        <li><a href="user-reports.html"> User Report </a></li>
                        <li><a href="employee-reports.html"> Employee Report </a></li>
                        <li><a href="payslip-reports.html"> Payslip Report </a></li>
                        <li><a href="attendance-reports.html"> Attendance Report </a></li>
                        <li><a href="leave-reports.html"> Leave Report </a></li>
                        <li><a href="daily-reports.html"> Daily Report </a></li>
                    </ul>
                </li>




                <li class="menu-title">
                    <span>Administration</span>
                </li>

                <li>
                    <a href="users.html"><i class="la la-user-plus"></i> <span>Users</span></a>
                </li>
                <li>
                    <a href="settings.html"><i class="la la-cog"></i> <span>Settings</span></a>
                </li>

                <li class="submenu">
                    <a href="#"><i class="la la-user"></i> <span> Profile </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="profile.html"> Employee Profile </a></li>
                        <li><a href="client-profile.html"> Client Profile </a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
