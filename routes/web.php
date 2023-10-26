<?php

use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\HelpLineController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\LocalizationController;
use App\Http\Controllers\frontend\OnlineVerificationController;
use App\Http\Controllers\Frontend\TermServiceController;
use App\Http\Controllers\Frontend\TutorialController;
use App\Http\Controllers\Frontend\UserManualController;

Route::get('/', [HomeController::class, 'index'])->name('front.home');

Route::get('search-lab', [LabController::class, 'searchLab'])->name('search.lab');

Route::name('front.')->group(function () {
    Route::get('about-us', [AboutController::class, 'index'])->name('about.index');
    Route::get('contact-us', [ContactController::class, 'index'])->name('contact.index');

    Route::get('user-manual', [UserManualController::class, 'index'])->name('user-manual.index');
    Route::get('all-user-manual', [UserManualController::class, 'allUserManual'])->name('user-manual.all');
    Route::post('user-manual-download', [UserManualController::class, 'download'])->name('user-manual.download');
    Route::get('load-more-tutorial', [UserManualController::class, 'loadMoreTutorial'])->name('load-more.tutorial');


    Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('blog/{slug}', [BlogController::class, 'singleBlog'])->name('blog.single');

    Route::get('privacy-policy', [TermServiceController::class, 'index'])->name('terms-service.index');
    Route::get('online-verification', [OnlineVerificationController::class, 'index'])->name('online-verification');
    Route::post('online-verification', [OnlineVerificationController::class, 'view'])->name('online-verification.view');
    Route::get('faqs', [FaqController::class, 'index'])->name('faq.index');

    Route::get('help-desk', [HelpLineController::class,'helpDesk'])->name('help.desk');
    Route::post('help-desk-submit', [HelpLineController::class,'helpDeskSubmit'])->name('help.desk.submit');
});


//____________LANGUAGE CHANGE____________//
Route::get('lang/{langVal}', [LocalizationController::class, 'langChange'])->name('lang.change');

require __DIR__ . '/auth.php';
