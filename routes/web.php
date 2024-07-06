<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Conference\ConferenceCategoryController;
use App\Http\Controllers\Conference\ConferenceController;
use App\Http\Controllers\Conference\ConferenceFeeController;
use App\Http\Controllers\Conference\ReportController;
use App\Http\Controllers\Conference\RegisterController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\HartController;
use App\Http\Controllers\VartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\VartContentController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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

    //File
    Route::prefix('file')->group(function () {
        Route::post('process', [FileController::class, 'process'])->name('file.process');
        Route::delete('revert', [FileController::class, 'revert'])->name('file.revert');
        Route::delete('/delete', [FileController::class, 'destroy'])->name('file.destroy');
        Route::post('/upload-image-ck', [FileController::class, 'upload_image_ck'])->name('file.upload_image_ck');
    });

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


    //Import Excel

    //Report Management
    Route::prefix('report-management')->group(function () {
        Route::prefix('report')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('conference_report.index');
            Route::get('edit/{id}', [ReportController::class, 'edit'])->name('conference_report.edit');
            Route::patch('update/{id}', [ReportController::class, 'update'])->name('conference_report.update');
            Route::delete('delete/{id}', [ReportController::class, 'destroy'])->name('conference_report.destroy');
        });
        Route::prefix('en-report')->group(function () {
            Route::get('/', [ReportController::class, 'indexInternational'])->name('conference_en_report.index');
            Route::get('edit/{id}', [ReportController::class, 'editInternational'])->name('conference_en_report.edit');
            Route::patch('update/{id}', [ReportController::class, 'updateInternational'])->name('conference_en_report.update');
            Route::delete('delete/{id}', [ReportController::class, 'destroyInternational'])->name('conference_en_report.destroy');
        });
    });

    //Register Management
    Route::prefix('register-management')->group(function () {
        Route::prefix('register')->group(function () {
            Route::get('/', [RegisterController::class, 'indexRegister'])->name('conference_register.index');
            Route::post('copy/{id}', [RegisterController::class, 'copyRegister'])->name('conference_register.copy');
            Route::get('edit/{id}', [RegisterController::class, 'editRegister'])->name('conference_register.edit');
            Route::patch('update/{id}', [RegisterController::class, 'updateRegister'])->name('conference_register.update');
            Route::delete('delete/{id}', [RegisterController::class, 'destroyRegister'])->name('conference_register.destroy');
            Route::post('/import-excel', [ExcelController::class, 'import'])->name('import-excel');
        });
        Route::prefix('en-register')->group(function () {
            Route::get('/', [RegisterController::class, 'indexRegisterInternational'])->name('conference_en_register.index');
            Route::get('edit/{id}', [RegisterController::class, 'editRegisterInternational'])->name('conference_en_register.edit');
            Route::patch('update/{id}', [RegisterController::class, 'updateRegisterInternational'])->name('conference_en_register.update');
            Route::delete('delete/{id}', [RegisterController::class, 'destroyRegisterInternational'])->name('conference_en_register.destroy');
        });
        Route::patch('send-mail-reply/{id}', [RegisterController::class, 'sendMailReply'])->name('sendMailReply');
    });

    Route::prefix('conference')->group(function () {
        Route::get('/', [ConferenceController::class, 'index'])->name('conference.index');
        Route::get('create', [ConferenceController::class, 'create'])->name('conference.create');
        Route::post('save', [ConferenceController::class, 'store'])->name('conference.store');
        Route::get('edit/{id}', [ConferenceController::class, 'edit'])->name('conference.edit');
        Route::patch('update/{id}', [ConferenceController::class, 'update'])->name('conference.update');
        Route::delete('delete/{id}', [ConferenceController::class, 'destroy'])->name('conference.destroy');
        //ConferenceFee
        Route::prefix('fee')->group(function () {
            Route::post('/', [ConferenceFeeController::class, 'index'])->name('conference_fee.index');
            Route::post('save-or-update', [ConferenceFeeController::class, 'storeOrUpdate'])->name('conference_fee.store_or_update');
            Route::delete('delete', [ConferenceFeeController::class, 'destroy'])->name('conference_fee.destroy');
        });
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
        Route::get('/', [VartController::class, 'index'])->name('vart.index');
        Route::get('create', [VartController::class, 'create'])->name('vart.create');
        Route::post('save', [VartController::class, 'store'])->name('vart.store');
        Route::get('edit/{id}', [VartController::class, 'edit'])->name('vart.edit');
        Route::patch('update/{id}', [VartController::class, 'update'])->name('vart.update');
        Route::delete('delete/{id}', [VartController::class, 'destroy'])->name('vart.destroy');
        Route::prefix('content')->group(function () {
            Route::post('/', [VartContentController::class, 'index'])->name('vart_content.index');
            Route::post('create-or-update', [VartContentController::class, 'storeOrUpdate'])->name('vart_content.store_or_update');
            Route::delete('delete', [VartContentController::class, 'destroy'])->name('vart_content.destroy');
        });
    });

    //Vart
    Route::prefix('hart')->group(function () {
        Route::get('/', [HartController::class, 'index'])->name('hart.index');
        Route::get('/create', [HartController::class, 'create'])->name('hart.create');
        Route::get('/edit/{id}', [HartController::class, 'edit'])->name('hart.edit');
        Route::get('/delete/{id}', [HartController::class, 'destroy'])->name('hart.destroy');
        Route::post('/save', [HartController::class, 'store'])->name('hart.store');
        Route::post('/update/{id}', [HartController::class, 'update'])->name('hart.update');
        Route::post('/load-hart-content', [HartController::class, 'loadHartContent'])->name('loadHartContent');
        Route::post('/add-hart-content', [HartController::class, 'createHartContent'])->name('createHartContent');
        Route::post('/update-hart-content', [HartController::class, 'updateHartContent'])->name('updateHartContent');
        Route::delete('/delete-hart-content/{id}', [HartController::class, 'destroyHartContent'])->name('destroyHartContent');
    });

    //Conference Category
    Route::prefix('conference-category')->group(function () {
        Route::get('/', [ConferenceCategoryController::class, 'index'])->name('conference_category.index');
        Route::get('create', [ConferenceCategoryController::class, 'create'])->name('conference_category.create');
        Route::post('save', [ConferenceCategoryController::class, 'store'])->name('conference_category.store');
        Route::get('edit/{id}', [ConferenceCategoryController::class, 'edit'])->name('conference_category.edit');
        Route::patch('update/{id}', [ConferenceCategoryController::class, 'update'])->name('conference_category.update');
        Route::delete('delete/{id}', [ConferenceCategoryController::class, 'destroy'])->name('conference_category.destroy');
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

// Invitation

Route::get('/intitation', [InvitationController::class, 'index'])->name('invitation.index');

Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    echo ('Config cache is available for configuration ');
});

Route::get('/route-clear', function () {
    Artisan::call('route:clear');
    echo ('route clear is available for configuration ');
});

Route::get('/route-clear', function () {
    Artisan::call('route:clear');
    echo ('route clear is available for configuration ');
});

//     return view('403');
// });
