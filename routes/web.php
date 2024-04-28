<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Conference\ConferenceCategoryController;
use App\Http\Controllers\Conference\ConferenceController;
use App\Http\Controllers\Conference\ReportController;
use App\Http\Controllers\Conference\RegisterController;
use App\Http\Controllers\HartController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\VartController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UploadController;
use App\Mail\MailConference;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;

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
Route::get('/', [AdminController::class, 'login']);

//-------------------------------------------- Backend --------------------------------------------
Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    //Dashboard
    Route::get('/dashboard', [AdminController::class, 'show_dashboard'])->name('dashboard');

    // Route::post('/revenue-statistics-by-date', [AdminController::class, 'revenue_statistics_by_date'])->name('url-revenue-statistics-by-date');
    // Route::post('/optional-revenue-statistics', [AdminController::class, 'optional_revenue_statistics'])->name('url-optional-revenue-statistics');
    // Route::post('/revenue-statistics-for-the-month', [AdminController::class, 'revenue_statistics_for_the_month'])->name('url-revenue-statistics-for-the-month');
    // Route::post('/revenue-statistics-by-unit', [AdminController::class, 'revenue_statistics_by_unit'])->name('url-revenue-statistics-by-unit');

    //Information Account
    Route::get('user/profile', [ProfileController::class, 'profile'])->name('user.profile');
    Route::get('user/profile/settings', [ProfileController::class, 'settings'])->name('user.settings');
    Route::post('user/profile/update', [ProfileController::class, 'update'])->name('user.update');

    //403
    Route::get('/403', function () {
        return view('403');
    })->name('403');

    //Blog Category
    Route::prefix('blog-category')->group(function () {
        Route::get('/', [BlogCategoryController::class, 'index'])->name('blog_category.index');
        Route::get('create', [BlogCategoryController::class, 'create'])->name('blog_category.create');
        Route::post('save', [BlogCategoryController::class, 'store'])->name('blog_category.store');
        Route::get('edit/{id}', [BlogCategoryController::class, 'edit'])->name('blog_category.edit');
        Route::patch('update/{id}', [BlogCategoryController::class, 'update'])->name('blog_category.update');
        Route::delete('delete/{id}', [BlogCategoryController::class, 'destroy'])->name('blog_category.destroy');
    });
    //Blog
    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('blog.index');
        Route::get('create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('save', [BlogController::class, 'store'])->name('blog.store');
        Route::get('edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::patch('update/{id}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('delete/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
    });
    //Export Excel
    Route::post('/export-excel', [ConferenceController::class, 'export_excel'])->name('export-excel');
    //Upload file
    Route::prefix('file')->group(function () {
        Route::post('/upload', [UploadController::class, 'store'])->name('upload');
        Route::delete('/delete/{path}', [UploadController::class, 'destroy'])->name('delete');
    });
    //Report Management
    Route::prefix('report-management')->group(function () {
        Route::prefix('report')->group(function () {
            Route::get('/', [ReportController::class, 'indexReport'])->name('conference_report.index');
            Route::get('edit/{id}', [ReportController::class, 'editReport'])->name('conference_report.edit');
            Route::patch('update/{id}', [ReportController::class, 'updateReport'])->name('conference_report.update');
            Route::delete('delete/{id}', [ReportController::class, 'destroyReport'])->name('conference_report.destroy');
        });
        Route::prefix('en-report')->group(function () {
            Route::get('/', [ReportController::class, 'indexReportInternational'])->name('conference_en_report.index');
            Route::get('edit/{id}', [ReportController::class, 'editReportInternational'])->name('conference_en_report.edit');
            Route::patch('update/{id}', [ReportController::class, 'updateReportInternational'])->name('conference_en_report.update');
            Route::delete('delete/{id}', [ReportController::class, 'destroyReportInternational'])->name('conference_en_report.destroy');
        });
    });

    //Register Management
    Route::prefix('register-management')->group(function () {
        Route::prefix('register')->group(function () {
            Route::get('/', [RegisterController::class, 'indexRegister'])->name('conference_register.index');
            Route::get('/edit/{id}', [RegisterController::class, 'editRegister'])->name('conference_register.edit');
            Route::patch('/update/{id}', [RegisterController::class, 'updateRegister'])->name('conference_register.update');
            Route::delete('delete/{id}', [RegisterController::class, 'destroyRegister'])->name('conference_register.destroy');
        });
        Route::prefix('en-register')->group(function () {
            Route::get('/', [RegisterController::class, 'indexRegisterInternational'])->name('conference_en_register.index');
            Route::get('/edit/{id}', [RegisterController::class, 'editRegisterInternational'])->name('conference_en_register.edit');
            Route::patch('/update/{id}', [RegisterController::class, 'updateRegisterInternational'])->name('conference_en_register.update');
            Route::delete('delete/{id}', [RegisterController::class, 'destroyRegisterInternational'])->name('conference_en_register.destroy');
        });
        Route::patch('send-mail-reply/{id}', [RegisterController::class, 'sendMailReply'])->name('sendMailReply');
    });

    Route::prefix('home-page')->group(function () {
        Route::get('/edit', [HomeController::class, 'edit'])->name('editHomePage');
        Route::post('/save', [HomeController::class, 'save'])->name('saveHomePage');
        Route::post('/update', [HomeController::class, 'update'])->name('updateHomePage');
    });

    Route::prefix('contact')->group(function () {
        Route::get('/edit', [ContactController::class, 'edit'])->name('edit-contact');
        Route::post('/save-info', [ContactController::class, 'save_info']);
        Route::post('/update', [ContactController::class, 'update'])->name('update-contact');
    });

    //Vart
    Route::prefix('vart')->group(function () {
        Route::get('/create', [VartController::class, 'create'])->name('createVart');
        Route::get('/', [VartController::class, 'list'])->name('listVart');
        Route::get('/edit/{id}', [VartController::class, 'edit'])->name('editVart');
        Route::get('/delete/{id}', [VartController::class, 'delete'])->name('deleteVart');
        Route::post('/save', [VartController::class, 'save'])->name('saveVart');
        Route::post('/update/{id}', [VartController::class, 'update'])->name('updateVart');
        Route::post('/load-vart-content', [VartController::class, 'loadVartContent'])->name('loadVartContent');
        Route::post('/create-or-update-vart-content', [VartController::class, 'saveOrUpdateVartContent'])->name('createOrUpdateVartContent');
        Route::delete('/delete-vart-content/{id}', [VartController::class, 'deleteVartContent'])->name('deleteVartContent');
    });

    //Vart
    Route::prefix('hart')->group(function () {
        Route::get('/create', [HartController::class, 'create'])->name('createHart');
        Route::get('/', [HartController::class, 'list'])->name('listHart');
        Route::get('/edit/{id}', [HartController::class, 'edit'])->name('editHart');
        Route::get('/delete/{id}', [HartController::class, 'delete'])->name('deleteHart');
        Route::post('/save', [HartController::class, 'save'])->name('saveHart');
        Route::post('/update/{id}', [HartController::class, 'update'])->name('updateHart');
        Route::post('/load-hart-content', [HartController::class, 'loadHartContent'])->name('loadHartContent');
        Route::post('/add-hart-content', [HartController::class, 'addHartContent'])->name('addHartContent');
        Route::post('/update-hart-content', [HartController::class, 'updateHartContent'])->name('updateHartContent');
        Route::delete('/delete-hart-content/{id}', [HartController::class, 'deleteHartContent'])->name('deleteHartContent');
    });

    //Conference Category
    Route::prefix('conference-category')->group(function () {
        Route::get('/create', [ConferenceCategoryController::class, 'create'])->name('createConferenceCategory');
        Route::get('/', [ConferenceCategoryController::class, 'list'])->name('listConferenceCategory');
        Route::get('/edit/{id}', [ConferenceCategoryController::class, 'edit'])->name('editConferenceCategory');
        Route::get('/delete/{id}', [ConferenceCategoryController::class, 'delete'])->name('deleteConferenceCategory');
        Route::post('/save', [ConferenceCategoryController::class, 'save'])->name('saveConferenceCategory');
        Route::post('/update/{id}', [ConferenceCategoryController::class, 'update'])->name('updateConferenceCategory');
    });

    Route::prefix('conference')->group(function () {
        Route::get('/create', [ConferenceController::class, 'create'])->name('createConference');
        Route::get('/', [ConferenceController::class, 'list'])->name('listConference');
        Route::get('/edit/{id}', [ConferenceController::class, 'edit'])->name('editConference');
        Route::get('/delete/{id}', [ConferenceController::class, 'delete'])->name('deleteConference');
        Route::post('/save', [ConferenceController::class, 'save'])->name('saveConference');
        Route::post('/update/{id}', [ConferenceController::class, 'update'])->name('updateConference');
        Route::post('/load-conference-fee', [ConferenceController::class, 'loadConferenceFee'])->name('loadConferenceFee');
        Route::post('/add-conference-fee', [ConferenceController::class, 'addConferenceFee'])->name('addConferenceFee');
        Route::post('/update-conference-fee', [ConferenceController::class, 'updateConferenceFee'])->name('updateConferenceFee');
        Route::delete('/delete-conference-fee/{id}', [ConferenceController::class, 'deleteConferenceFee'])->name('deleteConferenceFee');
    });



    //Slider
    Route::prefix('slider')->group(function () {
        Route::get('/list', [SliderController::class, 'list_slider'])->name('list-slider');
        Route::get('/add', [SliderController::class, 'add_slider'])->name('add-slider');
        Route::get('/delete/{slider_id}', [SliderController::class, 'delete_slider'])->name('delete-slider');
        Route::get('/edit/{slider_id}', [SliderController::class, 'edit_slider'])->name('edit-slider');
        Route::post('/insert', [SliderController::class, 'insert_slider'])->name('insert-slider');
        Route::post('/update/{slider_id}', [SliderController::class, 'update_slider'])->name('update-slider');
    });

    Route::get('per', [AdminController::class, 'per']);
});

Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    echo ('Config cache is available for configuration ');
});

Route::get('/route-clear', function () {
    Artisan::call('route:clear');
    echo ('route clear is available for configuration ');
});

Route::post('/upload-image-ck', [BlogController::class, 'upload_image_ck'])->name('upload-image-ck');

//     return view('403');
// });
