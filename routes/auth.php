<?php

use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\Admin\Candidate\ApplicantRegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\admin\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\user\UserController;
use App\Http\Controllers\Admin\user\AgentController;
use App\Http\Controllers\candidate\ExamController;
use App\Http\Controllers\Admin\exam\ActionController;
use App\Http\Controllers\Admin\exam\AllocationController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\blog\CourseblogController;
use App\Http\Controllers\candidate\ViewCandController;
use App\Http\Controllers\candidate\AdmissionController;
use App\Http\Controllers\department\DepartmentController;
use App\Http\Controllers\pin\PinController;
use App\Http\Controllers\candidate\AcceptanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\blog\DepartblogController;
use App\Http\Controllers\blog\EventController;
use App\Http\Controllers\candidate\UploadresultController;
use App\Http\Controllers\Online\OnlinePinController;
use App\Http\Controllers\SiteSettingontroller;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});


Route::group([
    'prefix' => 'panel',
    'middleware' => ['auth'],
], function () {

    // Site Settings
    Route::group([
        'prefix' => 'settings/configure',
    ], function () {
 
        Route::get('site', [SiteSettingontroller::class, 'sitesetting'])->name('admin.site.config');
        Route::get('payment', [AdminPaymentController::class, 'paymentsetting'])->name('admin.payment.create');
        Route::get('assigning', [AdminPaymentController::class, 'paymentassign'])->name('admin.payment.assign');
        Route::get('assigning/delete/{id}', [AdminPaymentController::class, 'paymentassigndelete'])->name('admin.payment.assign.delete');
        Route::post('assigning/store', [AdminPaymentController::class, 'paymentassignstore'])->name('admin.payment.assign.store');
        Route::post('payment', [AdminPaymentController::class, 'paymentsettingstore'])->name('admin.payment.store');
        Route::put('assigning/update', [SiteSettingontroller::class, 'paymentassignupdate'])->name('admin.payment.assign.update');
        Route::put('site/update', [SiteSettingontroller::class, 'sitesettingupdate'])->name('admin.site.config.store');
    });

    Route::group([
        'prefix' => 'admin',
    ], function () {

        Route::group([
            'prefix' => 'statistic',
        ], function () {

            Route::get('/dashboard', [StatisticController::class, 'dashboardstat'])->name('dashboard.statistic');
            Route::get('/candidate_register/config', [StatisticController::class, 'candidate_register_config'])->name('candidate.register.config');
        });
        Route::group([
            'prefix' => 'user',
        ], function () {
            /*........................USER ROUTE...........................*/
            Route::get('/create', [UserController::class, 'create'])->name('add_user');
            Route::get('/view', [UserController::class, 'view'])->name('view_user');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.edit.user');
            Route::get('/delete/{id}', [UserController::class, 'delete'])->name('admin.delete.user');
            Route::get('/permission', [UserController::class, 'permission'])->name('permission_user');
            Route::get('/permission/{id}', [UserController::class, 'permission_edit'])->name('edit_permission');
        });
        Route::group([
            'prefix' => 'exam',
        ], function () {
            /*........................EXAM ROUTE...........................*/
            Route::get('set/date', [ExamController::class, 'set_exam_date'])->name('exam_date');
            Route::get('/allocation', [AllocationController::class, 'index'])->name('exam_allocate');
            Route::get('/allocation/download', [AllocationController::class, 'export_candidates'])->name('export_candidates_list');
            Route::get('/allocation/view', [AllocationController::class, 'view'])->name('view_allocate');
            Route::get('allocation/batch/edit/{id}', [ActionController::class, 'edit_batch'])->name('edit.batch');
            Route::get('allocation/batch/delete/{id}', [ActionController::class, 'destroy_batch'])->name('delete.batch');
            Route::get('allocation/time/edit/{id}', [ActionController::class, 'edit_time'])->name('edit.time');
            Route::get('allocation/time/delete/{id}', [ActionController::class, 'destroy_time'])->name('delete.time');
        });
        Route::group([
            'prefix' => 'agent',
        ], function () {
            /*........................AGENT ROUTE...........................*/
            Route::get('/create', [AgentController::class, 'create'])->name('add_agent');
            Route::get('/view', [AgentController::class, 'view'])->name('view_agent');
            Route::get('/edit/{id}', [AgentController::class, 'edit'])->name('edit_agent');
            Route::get('/delete/{id}', [AgentController::class, 'delete'])->name('delete_agent');
        });

        Route::group([
            'prefix' => 'candidate',
        ], function () {

            Route::group([
                'prefix' => 'authenticate',
            ], function () {
                Route::get('/index', [ApplicantRegisterController::class, 'authenticate'])->name('admin.candidate.auth.index');
                Route::post('/check', [ApplicantRegisterController::class, 'checkauthenticate'])->name('admin.candidate.auth.check');
                Route::get('/register/{id}', [ApplicantRegisterController::class, 'registerapplicant'])->name('admin.candidate.auth.register');
                Route::post('/store', [ApplicantRegisterController::class, 'storeapplicant'])->name('admin.candidate.auth.save');
            });
            Route::group([
                'prefix' => 'pin',
            ], function () {


                Route::group([
                    'prefix' => 'manual',
                ], function () {
                    /*........................PIN ROUTE MANUAL...........................*/
                    Route::get('/generate', [PinController::class, 'index'])->name('add_pin');
                    Route::get('/print/{per_page}/{usepin}', [PinController::class, 'printcandidatepin'])->name('candidate.pin.print');
                    Route::get('/delete/{id}', [AgentController::class, 'destroy'])->name('pins.destroy');

                    Route::get('/course/generate', [PinController::class, 'course'])->name('course_pin');
                    Route::get('/change/course/delete/{id}', [AgentController::class, 'delete_course_pin'])
                        ->name('coursepins.destroy');

                    Route::get('/admission/generate', [PinController::class, 'admission'])->name('admission_pin');
                    Route::get('/admission/delete/{pinid}', [AgentController::class, 'delete_admission_pin'])
                        ->name('admission.destroy');
                });

                Route::group([
                    'prefix' => 'online',
                ], function () {

                    /*........................PIN ROUTE ONLINE...........................*/
                    Route::get('/index', [OnlinePinController::class, 'index'])->name('online.candidate.pin');
                    Route::Post('/configure', [OnlinePinController::class, 'store'])->name('online.candidate.pin.configure');
                    // Route::get('/print/{per_page}/{usepin}', [PinController::class, 'printcandidatepin'])->name('candidate.pin.print');
                    // Route::get('/delete/{id}', [AgentController::class, 'destroy'])->name('pins.destroy');

                    Route::get('/course/index', [PinController::class, 'course'])->name('online.course.pin');
                    // Route::get('/change/course/delete/{id}', [AgentController::class, 'delete_course_pin'])
                    //     ->name('coursepins.destroy');

                    Route::get('/admission/index', [PinController::class, 'admission'])->name('online.admission.pin');
                    // Route::get('/admission/delete/{pinid}', [AgentController::class, 'delete_admission_pin'])
                    //     ->name('admission.destroy');
                });
            });
        });

        Route::group([
            'prefix' => 'applicant',
        ], function () {

            /*........................APPLICANT ROUTE...........................*/
            Route::get('/view', [ViewCandController::class, 'index'])->name('view_applicant');
            Route::get('/photocard/{id}', [ViewCandController::class, 'show'])->name('admin.photocard.print');
            Route::get('/olevel', [ViewCandController::class, 'olevel'])->name('olevel_status');
            Route::get('/view/course', [ViewCandController::class, 'course_list'])->name('applicantcourse');
            Route::get('/edit/course/{id}', [ViewCandController::class, 'edit_course'])->name('admin.edit.course');
            Route::get('/result/upload', [UploadresultController::class, 'result_upload'])->name('resultupload');
            Route::get('/result/view', [UploadresultController::class, 'index'])->name('resultview');
            Route::get('/passort/export', [UploadresultController::class, 'passort'])->name('exortpassort');
            Route::get('/data/export', [ViewCandController::class, 'exportInfo'])->name('exportdetails');
            Route::get('/acceptanceletter/{admissionnumber}', [AcceptanceController::class, 'show'])->name('admin.acceptanceletter');
        });

        Route::group([
            'prefix' => 'admission',
        ], function () {
            /*........................ADMISSION ROUTE...........................*/
            Route::get('/upload', [AdmissionController::class, 'create'])->name('admission_upload');
            Route::get('/view', [AdmissionController::class, 'index'])->name('admission_view');
            Route::get('/lock', [AdmissionController::class, 'lock'])->name('admission_lock');
            Route::get('/export', [AdmissionController::class, 'export'])->name('admission_export');
        });

        Route::group([
            'prefix' => 'department',
        ], function () {
            /*........................DEPARTMENT ROUTE...........................*/
            Route::get('/create', [DepartmentController::class, 'create'])->name('add_department');
            Route::get('/view', [DepartmentController::class, 'index'])->name('view_department');
            Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit_department');
            Route::get('/delete/{id}', [DepartmentController::class, 'destroy'])->name('delete_department');
            Route::get('/programme/create', [DepartmentController::class, 'programme'])->name('add_programme');
            Route::get('/configure/cut_off_mark', [DepartmentController::class, 'cutoffmark'])->name('cutoffmark_depart');
            Route::get('/cutoff/delete/{id}', [DepartmentController::class, 'cutoffmark_delete'])->name('cutoff_delete');
            Route::get('/cutoff/edit/{id}', [DepartmentController::class, 'cutoffmark_edit'])->name('cutoff_edit');
        });

        Route::group([
            'prefix' => 'blog',
        ], function () {
            /*..................................................BLOG ROUTE.................................................*/
            Route::get('/department/create', [DepartblogController::class, 'create'])->name('depart_blog_add');
            Route::get('/department/view', [DepartblogController::class, 'index'])->name('depart_blog');
            Route::get('/department/edit/{id}', [DepartblogController::class, 'edit'])->name('depart_blog_edit');
            Route::get('/department/delete/{id}', [DepartblogController::class, 'destroy'])->name('depart_blog_delete');
            Route::get('/department/show/{id}', [DepartblogController::class, 'show'])->name('depart_blog_show');
            Route::get('/department/content/create', [DepartblogController::class, 'blog'])->name('departbloger');
            Route::get('/department/content/view', [DepartblogController::class, 'content'])->name('deptblogview');

            Route::get('/course/create', [CourseblogController::class, 'create'])->name('course_blog_add');
            Route::get('/course/view', [CourseblogController::class, 'index'])->name('course_blog');
            Route::get('/course/edit/{id}', [CourseblogController::class, 'edit'])->name('course_blog_edit');
            Route::get('/course/delete/{id}', [CourseblogController::class, 'destroy'])->name('course_blog_delete');
            Route::get('/course/show/{id}', [CourseblogController::class, 'show'])->name('course_blog_show');
            Route::get('/course/content/create', [CourseblogController::class, 'blog'])->name('coursebloger');
            Route::get('/course/content/view', [CourseblogController::class, 'content'])->name('courseblogview');

            Route::get('/event/create', [EventController::class, 'create'])->name('event_blog');
            Route::get('/event/view', [EventController::class, 'index'])->name('view_event');
        });
    });
});
