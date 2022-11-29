<?php

use \App\Http\Controllers\AppraisalReportController;
use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ServiceTypeController;
use \App\Http\Controllers\ProjectTypeController;
use \App\Http\Controllers\BillingFrequencyController;
use \App\Http\Controllers\BillingTypeController;
use \App\Http\Controllers\CurrencyController;
use \App\Http\Controllers\BenefitController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ChatController;
use App\Models\Attendance;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::post('loginUser', [\App\Http\Controllers\Auth\LoginController::class, 'loginUser'])->name('loginUser');

//Routes For Active Users
Route::group(['middleware' => ['auth', 'active_user','employee_exists']], function () {

    Route::get('loginUser',fn()=>redirect('/'));
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    Route::get('download_emp_upload_template', [App\Http\Controllers\EmployeeController::class, 'download_emp_upload_template'])->name('download_emp_upload_template');
    Route::resource('employees', App\Http\Controllers\EmployeeController::class);
    Route::resource('channels', App\Http\Controllers\ChannelController::class);
    Route::post('subscribe/{channel}', [App\Http\Controllers\ChannelController::class, 'subscribe'])->name('subscribe');
    Route::post('import_employees', ['App\Http\Controllers\EmployeeController', 'import'])->name('import_employees');
    Route::resource('users', App\Http\Controllers\UserController::class)->middleware('auth');
    Route::put('/users/{user}', [App\Http\Controllers\UserController::class, 'blockUser'])->name('users.ban');
    Route::get('users/forcedelete/one/{id}', [UserController::class, 'forcedelete'])->name('users.forcedelete');
    Route::get('users/restore/one/{id}', [UserController::class, 'restore'])->name('users.restore');
    Route::get('users/restoreAll', [UserController::class, 'restoreAll'])->name('users.restore.all');
    Route::resource('departments', App\Http\Controllers\DepartmentController::class)->middleware('auth');
    Route::resource('subscriptions', App\Http\Controllers\SubscriptionController::class)->middleware('auth');
    Route::resource('projects', App\Http\Controllers\ProjectController::class)->middleware('auth');
    Route::post('projects/allocate_employee/{project}', [App\Http\Controllers\ProjectController::class,'allocate_employees'])->name('employee_project.allocate_employees');
    Route::post('projects/re_allocate_employee/{employee}', [App\Http\Controllers\ProjectController::class,'re_allocate_employee'])->name('employee_project.reallocate_employees');
    Route::resource('roles', App\Http\Controllers\RoleController::class)->middleware('auth');
    Route::post('revoke_role', [App\Http\Controllers\RoleController::class, 'revoke_role'])->name('revoke_role');
    Route::post('roles/allocate_user/{role}', [App\Http\Controllers\RoleController::class,'allocate_user_to_role'])->name('user_role.allocate_users');
    Route::resource('permissions', App\Http\Controllers\PermissionController::class)->middleware('auth');
    Route::post('revoke_permission', [App\Http\Controllers\PermissionController::class, 'revoke_permission'])->name('revoke_permission');
    Route::resource('clients', App\Http\Controllers\ClientController::class)->middleware('auth');
    Route::get('clients/restore/one/{id}', [ClientController::class, 'restore'])->name('clients.restore');
    Route::get('restoreAll', [ClientController::class, 'restoreAll'])->name('clients.restore.all');
    Route::resource('teams', App\Http\Controllers\TeamController::class)->middleware('auth');
    Route::resource('leave_balances', App\Http\Controllers\LeaveBalanceController::class)->middleware('auth');
    Route::resource('account_managers', App\Http\Controllers\AccountManagerController::class)->middleware('auth');
    Route::resource('service_type', ServiceTypeController::class);
    Route::resource('project_type', ProjectTypeController::class);
    Route::resource('billing_frequency', BillingFrequencyController::class);
    Route::resource('billing_type', BillingTypeController::class);
    Route::resource('currency', CurrencyController::class);
    Route::resource('benefit', BenefitController::class);
    Route::post('create_employee', [\App\Http\Controllers\EmployeeController::class, 'store'])->name('create_employee');
    Route::post('edit_employee/{id}', [\App\Http\Controllers\EmployeeController::class, 'update'])->name('edit_employee');
    Route::post('create_appraisal', [\App\Http\Controllers\AppraisalController::class, 'store'])->name('create_appraisal');
    Route::post('manager_create_appraisal', [\App\Http\Controllers\AppraisalController::class, 'operationManager'])->name('manager_create_appraisal');
    Route::get('completed_appraisals', [\App\Http\Controllers\AppraisalReportController::class, 'done'])->name('completed_appraisals');
    Route::get('pending_appraisals', [\App\Http\Controllers\AppraisalReportController::class, 'pending'])->name('pending_appraisals');
    Route::get('view_appraisals', [\App\Http\Controllers\AppraisalController::class, 'index']);
    Route::post('om_review_appraisal', [\App\Http\Controllers\AppraisalController::class, 'operationManagerSupervisorReview'])->name('om_review_appraisal');
    Route::post('supervisor_review_appraisal', [\App\Http\Controllers\AppraisalController::class, 'supervisor_review_appraisal'])->name('supervisor_review_appraisal');
    Route::post('softwareDeveloperSupervisorReview', [\App\Http\Controllers\AppraisalController::class, 'softwareDeveloperSupervisorReview'])->name('softwareDeveloperSupervisorReview');
    Route::get('review/{employeeId}/{appraisalId}', [\App\Http\Controllers\AppraisalController::class, 'review'])->name('review');
    Route::get('my_appraisals', [\App\Http\Controllers\AppraisalController::class, 'mine'])->name('my_appraisals');
    Route::get('my_results/{appraisalId}', [\App\Http\Controllers\AppraisalController::class, 'myResult'])->name('my_results');
    Route::post('acknowledge_appraisal/{appraisalId}', [\App\Http\Controllers\AppraisalController::class, 'acknowledge'])->name('acknowledge_appraisal');
    Route::post('reject/{appraisalId}', [\App\Http\Controllers\AppraisalController::class, 'reject'])->name('reject');
    Route::get('view_employees', [\App\Http\Controllers\EmployeeController::class, 'index']);
    Route::get('employees/forcedelete/one/{id}', [EmployeeController::class, 'forcedelete'])->name('employees.forcedelete');
    Route::get('employees/restore/one/{id}', [EmployeeController::class, 'restore'])->name('employees.restore');
    Route::get('restoreAll', [EmployeeController::class, 'restoreAll'])->name('employees.restore.all');
    Route::resource('industry', \App\Http\Controllers\IndustryController::class);
    Route::resource('department', \App\Http\Controllers\DepartmentController::class);
    Route::get('/{department}/employees', [App\Http\Controllers\DepartmentController::class, 'department_employees'])->name('department_employees');
    Route::post('departments/re_allocate_employee/{employee}', [App\Http\Controllers\DepartmentController::class,'re_allocate_employee'])->name('employee_department.reallocate_employees');
    Route::post('departments/allocate_employee/{department}', [App\Http\Controllers\DepartmentController::class,'allocate_employees'])->name('employee_department.allocate_employees');
    Route::resource('designation', App\Http\Controllers\DesignationController::class);
    Route::post('designations/re_allocate_employee/{employee}', [App\Http\Controllers\DesignationController::class,'re_allocate_employee'])->name('employee_designation.reallocate_employees');
    Route::post('designations/allocate_employee/{designation}', [App\Http\Controllers\DesignationController::class,'allocate_employees'])->name('employee_designation.allocate_employees');
    Route::resource('appraisals', App\Http\Controllers\AppraisalController::class);
    Route::get('export_employees', [App\Http\Controllers\EmployeeController::class, 'export'])->name('export_employees');
    Route::resource('attendance', App\Http\Controllers\AttendanceController::class)->middleware('auth');
    Route::get('export_attendance', [App\Http\Controllers\AttendanceController::class, 'export'])->name('export_attendance');
    Route::get('attendance_download_template', [App\Http\Controllers\AttendanceController::class, 'download_template'])->name('attendance_download_template');
    Route::post('import_attendance', [App\Http\Controllers\AttendanceController::class, 'import'])->name('import_attendance');
    Route::post('attendance_filter', [App\Http\Controllers\AttendanceController::class, 'index'])->name('attendance_filter');
    Route::get('attendance_filter', [App\Http\Controllers\AttendanceController::class, 'index']);
    Route::resource('policies', App\Http\Controllers\PolicyController::class)->middleware('auth');
    Route::get('download_policy/{policy}', [App\Http\Controllers\PolicyController::class, 'download'])->name('download_policy')->middleware('auth');
    Route::resource('section-results', App\Http\Controllers\AppraisalSectionResultController::class);
    Route::get('/changePassword', [App\Http\Controllers\HomeController::class, 'showChangePasswordGet'])->name('changePasswordGet');
    Route::post('/changePassword', [App\Http\Controllers\HomeController::class, 'changePasswordPost'])->name('changePasswordPost');
    Route::get('/{contract}/employees', [App\Http\Controllers\ContractController::class, 'contract_employees'])->name('contract_employees');
    Route::resource('leaves', App\Http\Controllers\LeaveController::class);
    Route::get('my_leave_applications', [\App\Http\Controllers\LeaveController::class, 'my_leave_applications'])->name('leave.applications');
    Route::get('leaveStatistics/{employee}', [App\Http\Controllers\LeaveController::class, 'leaveStatistics'])->name('leaves.statistics');
    Route::post('edit_leavestat', [App\Http\Controllers\LeaveController::class,'leaveStatEdit'])->name('edit_leavestat');
    Route::post('leaves_filter', [App\Http\Controllers\LeaveController::class,'index'])->name('leaves_filter');
    Route::get('leaves_filter', [App\Http\Controllers\LeaveController::class,'index']);
    Route::post('approveleave/{leave}', [App\Http\Controllers\LeaveController::class, 'approve'])->name('approveleave');
    Route::resource('leavetypes', 'App\Http\Controllers\LeaveCategoryController');
    Route::resource('leave_balances', App\Http\Controllers\LeaveBalanceController::class)->middleware('auth');
    Route::resource('leave_type', App\Http\Controllers\LeaveCategoryController::class);
    Route::get('export_leaves', [App\Http\Controllers\LeaveController::class, 'export'])->middleware('auth')->name('export_leaves');
    Route::get('annual_leave_balances',[App\Http\Controllers\LeaveBalanceController::class, 'store_multiple'])->name('annual_leave_balances');
    Route::post('annual_leave_balances',[App\Http\Controllers\LeaveBalanceController::class, 'store_multiple'])->name('annual_leave_balances');
    Route::post('teams/allocate_employee/{team}', [App\Http\Controllers\TeamController::class,'allocate_employees'])->name('employee_team.allocate_employees');
    Route::post('teams/allocate_team_lead/{team}', [App\Http\Controllers\TeamController::class,'allocate_team_leads'])->name('team-leads_team.allocate_employees');
    Route::post('teams/re_allocate_employee/{employee}', [App\Http\Controllers\TeamController::class,'re_allocate_employee'])->name('team.reallocate_employees');
   //chat
//    Route::post('/chat',[App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat');
//    Route::get('/chat',[App\Http\Controllers\ChatController::class, 'chatPage'])->name('chat');
   Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chats.index');
   Route::get('/messages', [App\Http\Controllers\ChatController::class, 'fetchMessages'])->name('chat-messages');
   Route::post('/messages', [App\Http\Controllers\ChatController::class, 'sendMessage']);
    Route::match(['get', 'post'], '/botman', 'BotManController@handle');
    Route::get('leaves_on_monthly_attendance', [App\Http\Controllers\AttendanceController::class, 'leaves_on_attendance'])->name('leaves_on_attendance');
    Route::get('chart', [AttendanceController::class, 'chartjs'])->name('monthly_attendance_graph');
    Route::get('chart_last_month', [AttendanceController::class, 'chartLastMonth'])->name('previous_month_chart');
    Route::get('adminChart/{id}', [AttendanceController::class, 'adminChart'])->name('admin_chart');
    Route::get('adminChartLastMonth/{id}', [AttendanceController::class, 'adminChartLastMonth'])->name('admin_chart_last_month');
    Route::get('all_attendance', [AttendanceController::class, 'allAttendance'])->name('all_attendance');
    Route::get('all_attendance_last_month', [AttendanceController::class, 'allAttendanceLastMonth'])->name('all_attendance_last_month');
});

Route::post('search', [App\Http\Controllers\EmployeeController::class, 'search_employee'])->middleware('auth');
Route::resource('announcements', \App\Http\Controllers\AnnouncementController::class);

//Test Routes
Route::get('/noticeboard', function () {
    return view('noticeboard.notice-board');
});
Route::get('try', function () {
   dd(Mail::to('evelyn@gmail.com')->send(new App\Mail\UserCreated(User::first())));
    return true;
});
// Route::get('hr', function () {
//     return view('dashboards.hr');
// });
Route::get('notice', function () {
    return view('notice-board');
});

Route::get('/test', function () {
    return User::find(7)->announcements;
});

// Route::get('chart', function () {
//     return view('tests.chart');
// });
// Route::get('chartprac2', [UserController::class, 'chart']);
// Route::get('gen_chart', [UserController::class, 'user_gen_chart']);
// Route::get('chart3', function () {
//     return view('tests.chart-vue');
// })->name('chart-vue');

// Route::get('chart_attendance_on_leaves', [AttendanceController::class, 'chart_attendance_on_leaves']);
