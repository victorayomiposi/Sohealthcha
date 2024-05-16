<?php

use App\Models\blog\Event;
use Illuminate\Support\Facades\Route;
use App\Models\blog\course\Courseblog;
use App\Models\blog\department\Deptblog;
use App\Http\Controllers\JqueryController;
use App\Http\Controllers\pin\PinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\blog\EventController;
use App\Http\Controllers\pin\PaymentController;
use App\Http\Controllers\candidate\DataController;
use App\Http\Controllers\candidate\ExamController;
use App\Http\Controllers\Admin\user\UserController;
use App\Http\Controllers\blog\CourseblogController;
use App\Http\Controllers\blog\DepartblogController;
use App\Http\Controllers\Admin\user\AgentController;
use App\Http\Controllers\candidate\ResultController;
use App\Http\Controllers\Admin\exam\ActionController;
use App\Http\Controllers\candidate\RegisterController;
use App\Http\Controllers\candidate\ViewCandController;
use App\Http\Controllers\candidate\AuthcheckController;
use App\Http\Controllers\candidate\AcceptanceController;
use App\Http\Controllers\Admin\exam\AllocationController;
use App\Http\Controllers\department\DepartmentController;
use App\Http\Controllers\candidate\UploadresultController;
use App\Http\Controllers\pin\DepartmentPayment;
use App\Http\Controllers\Online\CandidateOnlineRegisterController;
use App\Http\Controllers\pin\AdditionalPayment;
use App\Http\Controllers\pin\AdditionalPaymentController;
use App\Http\Controllers\pin\OtherPaymentController;

Route::get('/', function () {
    $post = Deptblog::all();
    $courses = Courseblog::all();
    $event = Event::all();
    return view('welcome', compact('post', 'courses', 'event'));
})->name('home');


Route::prefix('payments')->group(function () {
    Route::Get('welcome', [PaymentController::class, 'index'])->name('payment.index');
    Route::Get('create', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('store', [PaymentController::class, 'store'])->name('payment.store');
    Route::Get('callback', [PaymentController::class, 'callback'])->name('payment.callback');
    Route::Get('verify/{transRef}', [PaymentController::class, 'verifyTransaction'])->name('payment.verify');
    Route::Get('download_pin_for_customer/{customerId}', [PaymentController::class, 'download_pin'])->name('customer.download.pin');

    Route::prefix('department')->group(function () {
        Route::Get('create', [DepartmentPayment::class, 'create'])->name('payment.department.create');
        Route::Get('welcome', [DepartmentPayment::class, 'index'])->name('payment.department.index');
        Route::Get('indigene/{id}', [DepartmentPayment::class, 'indigene'])->name('payment.department.create.indigene');
        Route::Get('nonindigene/{id}', [DepartmentPayment::class, 'nonindigene'])->name('payment.department.create.nonindigene');
        Route::post('store', [DepartmentPayment::class, 'store'])->name('payment.department.store');
        Route::Get('callback', [DepartmentPayment::class, 'callback'])->name('payment.department.callback');
        Route::Get('verify/{transRef}', [DepartmentPayment::class, 'verifyTransaction'])->name('payment.department.verify');
    });
    Route::prefix('others')->group(function () {
        Route::Get('create', [OtherPaymentController::class, 'create'])->name('payment.other.create');
        Route::Get('welcome', [OtherPaymentController::class, 'index'])->name('payment.other.index');
        Route::Get('indigene', [OtherPaymentController::class, 'indigene'])->name('payment.other.create.indigene');
        Route::Get('nonindigene', [OtherPaymentController::class, 'nonindigene'])->name('payment.other.create.nonindigene');
        Route::post('store', [OtherPaymentController::class, 'store'])->name('payment.other.store');
        Route::Get('callback', [OtherPaymentController::class, 'callback'])->name('payment.other.callback');
        Route::Get('verify/{transRef}', [OtherPaymentController::class, 'verifyTransaction'])->name('payment.other.verify');
    });

    Route::prefix('additional')->group(function () {
        Route::Get('create', [AdditionalPaymentController::class, 'create'])->name('payment.additional.create');
        Route::Get('check', [AdditionalPaymentController::class, 'check'])->name('payment.additional.check');
        Route::post('store', [AdditionalPaymentController::class, 'store'])->name('payment.additional.store');
        Route::Get('callback', [AdditionalPaymentController::class, 'callback'])->name('payment.additional.callback');
        Route::Get('verify/{transRef}', [AdditionalPaymentController::class, 'verifyTransaction'])->name('payment.additional.verify');
    });
});



Route::prefix('online/pin')->group(function () {
    Route::Get('login', [CandidateOnlineRegisterController::class, 'index'])->name('online.candidate.index');
    Route::post('authenticate', [CandidateOnlineRegisterController::class, 'authenticate'])->name('online.candidate.pin.authenticate');
    Route::post('store', [CandidateOnlineRegisterController::class, 'store'])->name('online.candidate.store');
    Route::get('logout', [CandidateOnlineRegisterController::class, 'logout'])->name('online.candidate.logout');
    Route::prefix('candidate')->middleware('pinauth')->group(function () {
        Route::Get('create', [CandidateOnlineRegisterController::class, 'create'])->name('online.candidate.create');
    });
});


Route::get('/get-lgas/{stateId}', [JqueryController::class, 'getLGAs']);
Route::get('/get-department/{departmentId}', [JqueryController::class, 'getDepartment']);
Route::get('/get-payment-amount/{paymentId}', [JqueryController::class, 'getpayments']);
Route::get('/get-payment-amount-for-school/{paymentId}', [JqueryController::class, 'getpaymentsschool']);
Route::get('/get-payment-amount-for-other/{paymentId}', [JqueryController::class, 'getpaymentsother']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*........................USER ROUTE...........................*/
Route::post('Store/user', [UserController::class, 'save_user'])->name('user_save');
Route::put('/user/update/{id}', [UserController::class, 'update_user'])->name('update_user');

/*........................AGENT ROUTE...........................*/
Route::post('Store/agent', [AgentController::class, 'save_agent'])->name('agent_save');
Route::put('/agent/update/{id}', [AgentController::class, 'update_agent'])->name('update_agent');

/*........................CANDIDATE ROUTE...........................*/
Route::get('/add/{pinnumber}/{serialnumber}/{access_coded}', [RegisterController::class, 'add'])->name('add');
Route::get('/fetch/photocard/{admissionnumber}', [DataController::class, 'fetchphotocard'])->name('fetch.photocard');
Route::get('authorize/user', [RegisterController::class, 'index'])->name('user_authorization');
Route::get('reprint/photocard', [DataController::class, 'index'])->name('reprint_photocard');
Route::POST('authenticate/user', [RegisterController::class, 'check_user'])->name('user_auth');
Route::POST('candidate/store', [RegisterController::class, 'store'])->name('candidate.save');
Route::POST('check/candidate/photocard', [DataController::class, 'store'])->name('check.photocard');
Route::put('/change/course/{id}', [ViewCandController::class, 'update_course'])->name('update_course');
Route::get('applicant/change/course', [DataController::class, 'change_course'])->name('changecourse');
Route::POST('check/candidate/course', [DataController::class, 'check'])->name('check.changecourse');
Route::get('course/change/{admissionnumber}/{Course}', [DataController::class, 'changeCourse'])->name('update.change_course');
Route::put('/update/change/course/{admissionnumber}', [ViewCandController::class, 'change_courses'])->name('course_update');
Route::get('candidate/result/login', [ResultController::class, 'index'])->name('candidate_result');
Route::POST('check/candidate/examresult', [ResultController::class, 'check'])->name('check.examresult');
Route::get('candidate/examresult/{admissionnumber}', [ResultController::class, 'examresult'])->name('update.examresult');
Route::POST('applicant/passort/exporting', [DataController::class, 'passport'])->name('export.passport');
Route::POST('applicant/applicant/exporting', [ViewCandController::class, 'applicantexport'])->name('export.applicant');

Route::get('/delete-duplicates', [ViewCandController::class, 'deleteDuplicates'])->name('delete.duplicates');

/*........................ADMISSION  ROUTE...........................*/
Route::post('/applicant/admission/lock', [UploadresultController::class, 'locked'])->name('admission.lock');


Route::post('/transfer/admissions', [UploadresultController::class, 'transferAdmissions'])->name('transfer.admissions');


/*........................CANDIDATE EXCEL...........................*/
Route::get('/export-template', [UploadresultController::class, 'exportTemplate'])->name('export.template');
Route::post('candidate/examresult/result/import', [ResultController::class, 'store_result'])->name('import.store');
Route::post('candidate/admission/import', [UploadresultController::class, 'store_admission'])->name('import.admission');



Route::get('candidate/acceptance/letter', [AcceptanceController::class, 'acceptance_index'])->name('candidate_acceptance');
Route::POST('check/candidate/acceptance', [AcceptanceController::class, 'acceptance_check'])->name('check.acceptance');
Route::get('candidate/acceptance/{admissionnumber}', [AcceptanceController::class, 'acceptance'])->name('print.acceptance');

Route::get('candidate/admission/letter', [AcceptanceController::class, 'admission_index'])->name('candidate_admission');
Route::POST('check/candidate/admission', [AcceptanceController::class, 'admission_check'])->name('check.admission');
Route::get('candidate/admission/{admissionnumber}', [AcceptanceController::class, 'admission'])->name('print.admission');

Route::POST('allocation/batch/store', [AllocationController::class, 'store'])->name('store.allocation');
Route::GET('allocation/batch/filter', [AllocationController::class, 'getBatchesAndTimes'])->name('get_batches_and_times');
Route::POST('allocation/time/store', [AllocationController::class, 'save'])->name('store.time');
Route::put('allocation/batch/update/{id}', [ActionController::class, 'update_batch'])->name('update.batch');
Route::put('allocation/time/update/{id}', [ActionController::class, 'update_time'])->name('update.time');

Route::put('/cutoffs/update/{id}', [DepartmentController::class, 'updatecutoff'])->name('cut-off.update');

Route::get('/admin/cutoff/{id}', [DepartmentController::class, 'getCutoff'])->name('getCutoff');
Route::put('/admin/cutoff/update/{id}', [DepartmentController::class, 'updateCutoff'])->name('updateCutoff');
/*........................CANDIDATE CHECK ROUTE GET METHOD...........................*/
Route::get('applicant/check/examdate', [AuthcheckController::class, 'checkexamdate'])->name('exam.date');

/*........................CANDIDATE CHECK ROUTE POST & PUT METHOD...........................*/
Route::post('applicant/auth/examdate', [AuthcheckController::class, 'authexamdate'])->name('auth.exam.date');

/*........................CANDIDATE CHECK ROUTE PDF...........................*/
Route::get('/fetch/examdate/{admissionnumber}', [AuthcheckController::class, 'fetchexamdate'])->name('fetch.examdate');

/*........................EXAM  ROUTE...........................*/
Route::POST('set/exam/date', [ExamController::class, 'store'])->name('examdate_save');



/*........................DEPARTMENT ROUTE...........................*/
Route::POST('insert/department', [DepartmentController::class, 'store'])->name('department_save');
Route::POST('insert/department/programme', [DepartmentController::class, 'store_programme'])->name('programme_save');
Route::put('/department/update/{id}', [DepartmentController::class, 'update'])->name('update_depart');
Route::POST('insert/department/cutofmark', [DepartmentController::class, 'store_cutoff'])->name('cutoff.store');

/*........................BLOG HOME ROUTE...........................*/
Route::get('/department/view/{id}', [DepartblogController::class, 'show']);

/*........................BLOG  ROUTE...........................*/
Route::POST('save/department/post', [DepartblogController::class, 'store'])->name('depart_post');
Route::PUT('update/department/post/{id}', [DepartblogController::class, 'update'])->name('depart_post_update');
Route::post('save/department/blog', [DepartblogController::class, 'blog_store'])->name('departblog');
Route::PUT('update/department/blog/{id}', [DepartblogController::class, 'blog_update'])->name('depart_blog_update');

Route::POST('save/course/post', [CourseblogController::class, 'store'])->name('course_post');
Route::PUT('update/course/post/{id}', [CourseblogController::class, 'update'])->name('course_post_update');
Route::post('save/course/blog', [CourseblogController::class, 'blog_store'])->name('courseblog');
Route::PUT('update/course/blog/{id}', [CourseblogController::class, 'blog_update'])->name('course_blog_update');
Route::get('/Course/view/{id}', [CourseblogController::class, 'show'])->name('course.blog.show');

Route::POST('save/event/post', [EventController::class, 'store'])->name('event');

Route::get('/duplicate/pin', [AuthcheckController::class, 'delete']);


/*........................PIN ROUTE...........................*/
Route::POST('pins', [PinController::class, 'store'])->name('pins.store');
Route::POST('coursepins', [PinController::class, 'save'])->name('course.store');
Route::POST('admission/pinstore', [PinController::class, 'admissionpinsave'])->name('admission.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
