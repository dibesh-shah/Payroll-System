<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\InboxController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\MailController;
use App\Models\Holiday;
use App\Models\Leave;
use Illuminate\Support\Facades\Auth;

// middleware(['auth.employee'])->

    Route::view('/', 'employee/welcome')->name('welcome');
// Employee routes
    Route::get('/register', [LoginController::class, 'createWithDepartment'])->name('employees.register');
    Route::post('/register', [LoginController::class, 'store'])->name('employees.store');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    Route::middleware(['auth.employee'])->prefix('employee')->group(function () {
        Route::view('/dashboard', 'employee/dashboard')->name('employees.dashboard');

        Route::get('/leave_apply', [LeaveRequestController::class, 'leaveHolidays'])->name('employee.leaveApply');
        Route::post('/leave_apply', [LeaveRequestController::class, 'store'])->name('leaveReq.store');
        Route::get('/leave_balance', [LeaveRequestController::class, 'balance']);
        Route::get('/leave_history', [LeaveRequestController::class, 'empHistory']);

        Route::get('/calendar', [HolidayController::class, 'showHolidays'])->name('employee.calendar');
        Route::get('/logout', [ProfileController::class, 'logout'])->name('logout');
        Route::get('/profile', [ProfileController::class, 'profile'])->name('employee.profile');
        Route::get('/update', [ProfileController::class, 'edit'])->name('employee.edit');
        Route::put('/update',[ProfileController::class, 'update'])->name('employee.update');
        Route::get('/password', [ProfileController::class, 'password'])->name('employee.password');
        Route::post('/password', [ProfileController::class, 'changePassword'])->name('employee.changePassword');

        Route::get('/inbox', [InboxController::class, 'indexEmp'])->name('employee.inbox');
        Route::Post('/inbox', [InboxController::class, 'storeEmp']);
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('employee.attendance');
        Route::get('/payslip/{id}', [PayrollController::class, 'payslip'])->name('employee.payslip');
        Route::get('/tax', [TaxController::class, 'indexEmp'])->name('taxEmp');


    });
    Route::middleware(['auth.employee'])->group(function(){
        Route::post('/clock-in', [AttendanceController::class, 'clockIn'])->name('clock.in');
        Route::post('/clock-out', [AttendanceController::class, 'clockOut'])->name('clock.out');
    });






    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [LoginController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/department', [DepartmentController::class, 'index'])->name('departments.index');
    Route::post('/department', [DepartmentController::class, 'store'])->name('departments.store');
    Route::post('/department/edit', [DepartmentController::class,'edit'])->name('departments.edit');
    Route::delete('/department/{department}', [DepartmentController::class, 'destroy'])->name('departments.destroy');
    // Leave  routes
    Route::get('/leave', [LeaveController::class, 'index'])->name('leave.index');
    Route::get('/leave/create', [LeaveController::class, 'create'])->name('leave.create');
    Route::post('/leave', [LeaveController::class, 'store'])->name('leave.store');
    Route::post('/leave/edit', [LeaveController::class,'edit'])->name('leave.edit');
    Route::delete('/leave/{leave}', [LeaveController::class, 'destroy'])->name('leave.destroy');
    // Approve  routes
    Route::get('approve', [EmployeeController::class, 'index'])->name('employees.index');
    Route::post('/approve/{id}', [EmployeeController::class, 'approveEmployee'])->name('employees.approve');
    Route::post('/approve/reject/{id}', [EmployeeController::class, 'rejectEmployee'])->name('employees.reject');
    Route::get('/approve/{id}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employee/document/{filename}',[EmployeeController::class,'showDocument'])->name('employee.document');

    // Route::get('/view_employees', [EmployeeController::class, 'viewEmployees'])->name('employees.viewEmployees');
    Route::get('/view_employee', [EmployeeController::class, 'viewEmployee'])->name('employees.viewEmployee');

    Route::get('/attendance', [AttendanceController::class, 'showAttendance'])->name('attendance.show');
    Route::post('/attendance', [AttendanceController::class, 'addAttendance'])->name('attendance.add');

    // Allowance  routes
    Route::get('/allowance', [AllowanceController::class, 'index'])->name('allowance.index');
    Route::get('/allowance/create', [AllowanceController::class, 'create'])->name('allowance.create');
    Route::post('/allowance', [AllowanceController::class, 'store'])->name('allowance.store');
    Route::post('/allowance/edit', [AllowanceController::class,'edit'])->name('allowance.edit');
    Route::delete('/allowance/{allowance}', [AllowanceController::class, 'destroy'])->name('allowance.destroy');
    // Deduction  routes
    Route::get('/deduction', [DeductionController::class, 'index'])->name('deduction.index');
    Route::get('/deduction/create', [DeductionController::class, 'create'])->name('deduction.create');
    Route::post('/deduction', [DeductionController::class, 'store'])->name('deduction.store');
    Route::post('/deduction/edit', [DeductionController::class,'edit'])->name('deduction.edit');
    Route::delete('/deduction/{deduction}', [DeductionController::class, 'destroy'])->name('deduction.destroy');
    Route::get('/leave_request', [LeaveRequestController::class, 'index'])->name('leaveReq.index');
    Route::get('/leave_detail/{id}', [LeaveRequestController::class, 'show'])->name('leaveReq.show');
    Route::post('/leave_request', [LeaveRequestController::class, 'idSearch'])->name('leaveReq.search');
    Route::get('/leave_history', [LeaveRequestController::class, 'adminHistory']);
    Route::get('/leave_assign', [LeaveRequestController::class, 'leaveAssign']);
    Route::post('/assign_leave', [LeaveRequestController::class, 'assignLeave']);

    Route::post('/leave_detail/approve/{id}', [LeaveRequestController::class, 'approveLeave'])->name('leave.approve');
    Route::post('/leave_detail/reject/{id}', [LeaveRequestController::class, 'rejectLeave'])->name('leave.reject');


    Route::get('/generate', [PayrollController::class, 'show']);
    Route::get('/payroll/{id}', [PayrollController::class, 'payroll'])->name('payroll.payroll');
    Route::post('/payroll/approve', [PayrollController::class, 'approve'])->name('payroll.approve');
    Route::post('/payroll/reject/{id}', [PayrollController::class, 'reject'])->name('payroll.reject');


    Route::get('/tax', [TaxController::class, 'index'])->name('tax');
    Route::post('/tax_entry', [TaxController::class, 'store'])->name('tax.store');
    Route::get('/tax_entry', [TaxController::class, 'show'])->name('tax.show');
    Route::get('/tax/{year}/{next}/{status}',  [TaxController::class, 'update']);
    Route::post('/tax_updateEntry', [TaxController::class, 'updateTax'])->name('tax.update');



   Route::get('/calendar', [HolidayController::class, 'getHolidays'])->name('admin.calendar');

   Route::post('/save-holidays', [HolidayController::class,'saveHolidays']);

    Route::get('/inbox', [InboxController::class, 'index'])->name('admin.inbox');
    Route::get('/inbox/{id}', [InboxController::class, 'getUser'])->name('admin.getUser');

    Route::Post('/inbox', [InboxController::class, 'store']);

    Route::Post('/inbox/search', [InboxController::class, 'search']);

    // Route::view('/dashboard', 'admin/dashboard')->name('admin.dashboard');

    Route::get('/logout', [ProfileController::class, 'logoutAdmin'])->name('adminLogout');

    });



        Route::get('/admin', [LoginController::class, 'showAdminLoginForm'])->name('admin.login');
        Route::post('/admin/login', [LoginController::class, 'adminLogin'])->name('admin.login.submit');


// Route::view('/leave_balance', 'employee/leave_balance');
// Route::view('/leave_history', 'employee/leave_history');



Route::Post('/employee/inbox/adminMssgFetch', [InboxController::class, 'getMessage']);
Route::Post('/admin/inbox/employeeMssgFetch', [InboxController::class, 'getMessage']);


// Route::get('/api/employees/suggestions', 'EmployeeController@suggestions');

// Route::get('send-mail',[MailController::class, 'index']);











