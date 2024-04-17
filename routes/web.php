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
use App\Http\Controllers\ConferenceCategoryController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\HartController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\VartController;
use App\Http\Controllers\LocalizationController;
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

    Route::post('/revenue-statistics-by-date', [AdminController::class, 'revenue_statistics_by_date'])->name('url-revenue-statistics-by-date');
    Route::post('/optional-revenue-statistics', [AdminController::class, 'optional_revenue_statistics'])->name('url-optional-revenue-statistics');
    Route::post('/revenue-statistics-for-the-month', [AdminController::class, 'revenue_statistics_for_the_month'])->name('url-revenue-statistics-for-the-month');
    Route::post('/revenue-statistics-by-unit', [AdminController::class, 'revenue_statistics_by_unit'])->name('url-revenue-statistics-by-unit');

    //Information Account
    Route::get('/information', [AdminController::class, 'information'])->name('information');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/save-infomation', [AdminController::class, 'save_information'])->name('save-information');

    //403
    Route::get('/403', function () {
        return view('403');
    })->name('403');

    //Category Blog
    Route::prefix('blog-category')->group(function () {
        Route::get('/add', [BlogCategoryController::class, 'add'])->name('addBlogCategory');
        Route::get('/list', [BlogCategoryController::class, 'list'])->name('listBlogCategory');
        Route::get('/edit/{blog_category_id}', [BlogCategoryController::class, 'edit'])->name('editBlogCategory');
        Route::get('/delete/{blog_category_id}', [BlogCategoryController::class, 'delete'])->name('deleteBlogCategory');
        Route::post('/save', [BlogCategoryController::class, 'save'])->name('saveBlogCategory');
        Route::post('/update/{blog_category_id}', [BlogCategoryController::class, 'update'])->name('updateBlogCategory');
    });


    //Export Excel
    Route::post('/export-excel', [ConferenceController::class, 'export_excel'])->name('export-excel');

    //Sales
    Route::group(['middleware' => 'isStaff'], function () {
        //Conference
        Route::prefix('conference')->group(function () {
            Route::prefix('report')->group(function () {
                Route::get('list', [ConferenceController::class, 'listReport'])->name('listConferenceReport');
                Route::get('edit/{id}', [ConferenceController::class, 'editReport'])->name('editConferenceReport');
                Route::patch('update/{id}', [ConferenceController::class, 'updateReport'])->name('updateConferenceReport');
                Route::delete('delete/{id}', [ConferenceController::class, 'deleteReport'])->name('deleteConferenceReport');
            });
            Route::prefix('en-report')->group(function () {
                Route::get('/list', [ConferenceController::class, 'listReportInternational'])->name('listConferenceReportInternational');
                Route::get('/edit/{id}', [ConferenceController::class, 'editReportInternational'])->name('editConferenceReportInternational');
                Route::patch('/update/{id}', [ConferenceController::class, 'updateReportInternational'])->name('updateConferenceReportInternational');
                Route::delete('delete/{id}', [ConferenceController::class, 'deleteReportInternational'])->name('deleteConferenceReportInternational');
            });
            Route::prefix('register')->group(function () {
                Route::get('/list', [ConferenceController::class, 'listRegister'])->name('listConferenceRegister');
                Route::get('/edit/{id}', [ConferenceController::class, 'editRegister'])->name('editConferenceRegister');
                Route::patch('/update/{id}', [ConferenceController::class, 'updateRegister'])->name('updateConferenceRegister');
                Route::delete('delete/{id}', [ConferenceController::class, 'deleteRegister'])->name('deleteConferenceRegister');
            });
            Route::prefix('en-register')->group(function () {
                Route::get('/list', [ConferenceController::class, 'listRegisterInternational'])->name('listConferenceRegisterInternational');
                Route::get('/edit/{id}', [ConferenceController::class, 'editRegisterInternational'])->name('editConferenceRegisterInternational');
                Route::patch('/update/{id}', [ConferenceController::class, 'updateRegisterInternational'])->name('updateConferenceRegisterInternational');
                Route::delete('delete/{id}', [ConferenceController::class, 'deleteRegisterInternational'])->name('deleteConferenceRegisterInternational');
            });
            Route::patch('send-mail-reply/{id}', [ConferenceController::class, 'sendMailReply'])->name('sendMailReply');
        });
    });

    //Admin
    Route::group(['middleware' => 'isAdmin'], function () {
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
            Route::get('/add', [VartController::class, 'add'])->name('addVart');
            Route::get('/list', [VartController::class, 'list'])->name('listVart');
            Route::get('/edit/{id}', [VartController::class, 'edit'])->name('editVart');
            Route::get('/delete/{id}', [VartController::class, 'delete'])->name('deleteVart');
            Route::post('/save', [VartController::class, 'save'])->name('saveVart');
            Route::post('/update/{id}', [VartController::class, 'update'])->name('updateVart');
            Route::post('/load-vart-content', [VartController::class, 'loadVartContent'])->name('loadVartContent');
            Route::post('/add-vart-content', [VartController::class, 'addVartContent'])->name('addVartContent');
            Route::post('/update-vart-content', [VartController::class, 'updateVartContent'])->name('updateVartContent');
            Route::delete('/delete-vart-content/{id}', [VartController::class, 'deleteVartContent'])->name('deleteVartContent');
        });

        //Vart
        Route::prefix('hart')->group(function () {
            Route::get('/add', [HartController::class, 'add'])->name('addHart');
            Route::get('/list', [HartController::class, 'list'])->name('listHart');
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
            Route::get('/add', [ConferenceCategoryController::class, 'add'])->name('addConferenceCategory');
            Route::get('/list', [ConferenceCategoryController::class, 'list'])->name('listConferenceCategory');
            Route::get('/edit/{id}', [ConferenceCategoryController::class, 'edit'])->name('editConferenceCategory');
            Route::get('/delete/{id}', [ConferenceCategoryController::class, 'delete'])->name('deleteConferenceCategory');
            Route::post('/save', [ConferenceCategoryController::class, 'save'])->name('saveConferenceCategory');
            Route::post('/update/{id}', [ConferenceCategoryController::class, 'update'])->name('updateConferenceCategory');
        });

        Route::prefix('conference')->group(function () {
            Route::get('/add', [ConferenceController::class, 'add'])->name('addConference');
            Route::get('/list', [ConferenceController::class, 'list'])->name('listConference');
            Route::get('/edit/{id}', [ConferenceController::class, 'edit'])->name('editConference');
            Route::get('/delete/{id}', [ConferenceController::class, 'delete'])->name('deleteConference');
            Route::post('/save', [ConferenceController::class, 'save'])->name('saveConference');
            Route::post('/update/{id}', [ConferenceController::class, 'update'])->name('updateConference');
            Route::post('/load-conference-fee', [ConferenceController::class, 'loadConferenceFee'])->name('loadConferenceFee');
            Route::post('/add-conference-fee', [ConferenceController::class, 'addConferenceFee'])->name('addConferenceFee');
            Route::post('/update-conference-fee', [ConferenceController::class, 'updateConferenceFee'])->name('updateConferenceFee');
            Route::delete('/delete-conference-fee/{id}', [ConferenceController::class, 'deleteConferenceFee'])->name('deleteConferenceFee');
        });

        //Blog
        Route::prefix('blog')->group(function () {
            Route::get('/add', [BlogController::class, 'add'])->name('addBlog');
            Route::get('/list', [BlogController::class, 'list'])->name('listBlog');
            Route::get('/edit/{blog_id}', [BlogController::class, 'edit'])->name('editBlog');
            Route::get('/delete/{blog_id}', [BlogController::class, 'delete'])->name('deleteBlog');
            Route::post('/save', [BlogController::class, 'save'])->name('saveBlog');
            Route::post('/update/{blog_id}', [BlogController::class, 'update'])->name('updateBlog');
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
    });
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
