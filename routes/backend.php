<?php

use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\ApplicationController;
use App\Http\Controllers\Backend\ApplicationFilteringController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CertificateController;
use App\Http\Controllers\Backend\ChangeRequestController;
use App\Http\Controllers\Backend\ChangeRequestFeeController;
use App\Http\Controllers\Backend\CounterController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\CustomerDetailController;
use App\Http\Controllers\Backend\CustomerRegistrationController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DirectorController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\DivisionController;
use App\Http\Controllers\Backend\FaController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\FeeStructureController;
use App\Http\Controllers\Backend\HelpLineController;
use App\Http\Controllers\Backend\LabController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\ModeOfTransportController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\OTPController;
use App\Http\Controllers\Backend\ProcessController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\RfsoController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\ShareController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SoController;
use App\Http\Controllers\Backend\TermServiceController;
use App\Http\Controllers\Backend\TutorialController;
use App\Http\Controllers\Backend\TypeGoodController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\UserManualController;
use App\Http\Controllers\Backend\WebsiteController;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;

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

// Auth::routes();

Route::group(['middleware' => ['auth', 'checkPasswordUpdate', 'active']], function () {
    Route::get('home', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);

    Route::get('countries',[CountryController::class,'index'])->name('countries.index');
    Route::resource('divisions', DivisionController::class)->only(['index']);
    Route::resource('districts', DistrictController::class)->only(['index']);

    Route::resource('type-goods', TypeGoodController::class);

    Route::get('application', [ApplicationController::class, 'index'])->name('application.index');
    Route::get('application/create', [ApplicationController::class, 'create'])->name('application.create');
    Route::post('application/store', [ApplicationController::class, 'store'])->name('application.store');
    Route::get('application/edit', [ApplicationController::class, 'edit'])->name('application.edit');
    Route::post('application/update', [ApplicationController::class, 'update'])->name('application.update');
    Route::get('application/fee', [ApplicationController::class, 'calculateFee'])->name('application.fee');
    Route::get('application/payment/invoice',[ApplicationController::class,'invoice'])->name('application.payment.invoice');
    Route::get('application/noc/download',[ApplicationController::class,'nocDownload'])->name('download.noc');
    Route::get('application/status', [ApplicationController::class, 'status'])->name('application.status');

    Route::get('application/{id}/process', [ProcessController::class, 'applicationProcess'])->name('application.process');
    Route::get('application/remark', [ProcessController::class, 'remark'])->name('application.remark');
    // Route::get('application/ajax/remark', [ProcessController::class, 'remark'])->name('application.remark');
    Route::get('view/{id}/remark', [ProcessController::class, 'viewRemark'])->name('view.remark');

    /***********FA PANEL***********/
    Route::post('fa-first/process', [FaController::class, 'faFirstProcess'])->name('fa.first.process');
    Route::post('onhold/process', [FaController::class, 'onholdProcess'])->name('onhold.process');
    Route::post('fa-second/process', [FaController::class, 'faSecondProcess'])->name('fa.second.process');
    Route::post('fa-forward/user', [FaController::class, 'faForwardUser'])->name('fa.forward.user');
    Route::post('fa-second/reject', [FaController::class, 'faSecondReject'])->name('fa.second.reject');
    Route::post('fa/resampling', [FaController::class, 'faResampling'])->name('fa.resampling');

    /***********FSO PANEL***********/
    Route::post('rfso/process', [RfsoController::class, 'rfsoProcess'])->name('rfso.process');

    /***********LAB PANEL***********/
    Route::post('received/sample', [LabController::class, 'receivedSample'])->name('received.sample');
    Route::post('lab/process', [LabController::class, 'labProcess'])->name('lab.process');
    Route::post('lab/resampling', [LabController::class, 'labResampling'])->name('lab.resampling');


    /***********SO PANEL***********/
    Route::post('so-first/process', [SoController::class, 'soFirstProcess'])->name('so.first.process');
    Route::post('so-first/reject', [SoController::class, 'soFirstReject'])->name('so.first.reject');
    Route::post('so-finalized/process', [SoController::class, 'soFinalizedProcess'])->name('so.finalized.process');
    Route::post('so-forward/user', [SoController::class, 'soForwardUser'])->name('so.forward.user');
    Route::post('so-fianl/reject', [SoController::class, 'soFinalReject'])->name('so.final.reject');


    /***********Director PANEL***********/
    Route::post('director-first/process', [DirectorController::class, 'directorFirstProcess'])->name('director.first.process');
    Route::post('director-second/process', [DirectorController::class, 'directorSecondProcess'])->name('director.second.process');
    Route::post('director-forward/user', [DirectorController::class, 'directorForwardUser'])->name('director.forward.user');
    Route::post('director-process/skip', [DirectorController::class, 'processSkip'])->name('director.process.skip');

    /***********Member PANEL***********/
    Route::post('member-first/process', [MemberController::class, 'memberFirstProcess'])->name('member.first.process');
    Route::post('member-process/skip', [MemberController::class, 'processSkip'])->name('member.process.skip');


    Route::resource('customers', CustomerController::class)->only(['index','show']);
    Route::get('changeStatus', [CustomerController::class, 'changeStatus'])->name('change.status');

    //___CustomerDetailController Route__//
    Route::post('customer-details/store', [CustomerDetailController::class, 'store'])->name('customer.details.store');
    Route::post('customer-details/update',[CustomerDetailController::class,'update'])->name('customer.profile.update');
    Route::get('customer-details/download', [CustomerDetailController::class, 'download'])->name('customer.details.download');


    //__Profile Controller__//
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('password/change',[ProfileController::class,'changePassword'])->name('change.password');
    Route::post('password/update',[ProfileController::class,'passwordUpdate'])->name('password.change.update');
    Route::post('profile/image/update',[ProfileController::class,'profileImageUpdate'])->name('profile.image.update');


    //Certificate Controller
    Route::get('certificate',[CertificateController::class,'index'])->name('certificate.index');
    Route::get('customer/{applicationId?}/certificate',[CertificateController::class,'view'])->name('certificate.view');
    Route::post('customer/certificate/view',[CertificateController::class,'certificate'])->name('certificate');
    Route::post('customer/certificate/change-request',[CertificateController::class,'changeRequest'])->name('certificate.change.request');

    //Certificate Change Request
    Route::get('change-request',[ChangeRequestController::class,'index'])->name('change-request.index');
    Route::get('change-request/view/{id}/remark', [ChangeRequestController::class, 'viewRemark'])->name('change-request.remark');
    Route::get('change-request/edit/{id}/certificate', [ChangeRequestController::class, 'edit'])->name('change-request.edit');
    Route::post('change-request/update/certificate', [ChangeRequestController::class, 'update'])->name('change-request.update');
    Route::post('change-request/customer/payment',[ChangeRequestController::class,'payment'])->name('changerequest.bank.payment');

    //___________________CMS___________________//
    Route::resource('sliders', SliderController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('tutorials', TutorialController::class);
    Route::resource('abouts', AboutController::class)->only('index','update');
    Route::resource('user-manuals', UserManualController::class);
    Route::resource('fee-structures', FeeStructureController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('term-services',TermServiceController::class)->only('index','update');
    Route::resource('websites', WebsiteController::class)->only('index','update');


    Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
    Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

    Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
    Route::post('change_request/payment', [SslCommerzPaymentController::class, 'changeRequestPay'])->name('change_request.payment'); //change request payment
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
    //SSLCOMMERZ END


    # Notifications
    Route::get('all-notification', [NotificationController::class, 'allNotification'])->name('all.notification');
    Route::get('notifications/read/{notification}', [NotificationController::class, 'read'])->name("notifications.read");

    // ChangeRequestFee
    Route::resource('change-request-fees',ChangeRequestFeeController::class)->only('index','store');

    // ModeOfTransportController Controller
    Route::resource('transport-modes',ModeOfTransportController::class);

    //Application Filtering Controller
    Route::get('application/pending',[ApplicationFilteringController::class,'pending'])->name('application.pending');

    //Help Line
    Route::get('help-line', [HelpLineController::class, 'helpLine'])->name('help.line');
    Route::get('help-line-complete', [HelpLineController::class, 'helpLineComplete'])->name('help.line.complete');
    Route::post('help-line-complete-submit', [HelpLineController::class, 'helpLineCompleteSubmit'])->name('help.line.submit');

});


Route::get('get-division/{id}', [ApplicationController::class, 'getDivision']);

// Custom Register with otp
Route::post('register', [CustomerRegistrationController::class, 'registerValidation'])->name('registration.valid');
Route::get('register/auth_registration_otp', [OTPController::class, 'index'])->name('otp.index');
Route::post('register/otp/verify', [OTPController::class, 'verifyOtp'])->name('otp.verify');
Route::get('register/verify_auth_email', [OTPController::class, 'checkMail'])->name('check.mail');
Route::get('register/get-district/', [OTPController::class, 'getDistrict']);
Route::get('/remove-otp-session',[OTPController::class, 'removeOtpSession'])->name('otp-session.remove');
Route::post('otp-resend',[CustomerRegistrationController::class, 'resendOtp'])->name('resend.otp');

//Certiface view by unauthorize user
Route::get('customer/{applicationId?}/certificate/view',[CertificateController::class,'certificateView'])->name('customer.certificate.view');
Route::post('customer/view/certificate',[CertificateController::class,'certificate'])->name('customer.view.certificate');
Route::post('/share',[ShareController::class,'share'])->name('share');
