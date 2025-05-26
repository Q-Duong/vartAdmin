<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AlbumController;
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
use App\Http\Controllers\HrttaController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\VartContentController;
use Barryvdh\DomPDF\Facade\Pdf;
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
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard.index');
    // HomePage
    Route::prefix('home-page')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('homePage.index');
        Route::post('create-or-update', [HomeController::class, 'storeOrUpdate'])->name('homePage.store_or_update');
        Route::post('render', [HomeController::class, 'render'])->name('homePage.render');
        Route::delete('delete', [HomeController::class, 'destroy'])->name('homePage.destroy');
    });
    //Contact
    Route::prefix('contact')->group(function () {
        Route::get('/edit', [ContactController::class, 'edit'])->name('contact.edit');
        Route::post('/store', [ContactController::class, 'store'])->name('contact.store');
        Route::patch('/update', [ContactController::class, 'update'])->name('contact.update');
    });
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
        Route::delete('delete', [FileController::class, 'destroy'])->name('file.destroy');
        Route::delete('delete-content', [FileController::class, 'destroyContent'])->name('file.destroy_content');
        Route::post('upload-image-ck', [FileController::class, 'upload_image_ck'])->name('file.upload_image_ck');
    });

    //Support
    Route::post('export-excel', [SupportController::class, 'export'])->name('export.excel');
    Route::get('print', [SupportController::class, 'print'])->name('invitation.print');
    Route::post('send-mail-reply/{id}', [SupportController::class, 'sendMailReply'])->name('mail.reply');

    //Report Management
    Route::prefix('report-management')->group(function () {
        Route::prefix('report')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('report_management.index');
            Route::get('{code}', [ReportController::class, 'indexNational'])->name('conference_report.index');
            Route::get('{code}/edit/{id}', [ReportController::class, 'edit'])->name('conference_report.edit');
            Route::post('{code}/update', [ReportController::class, 'update'])->name('conference_report.update');
            Route::delete('delete/{id}', [ReportController::class, 'destroy'])->name('conference_report.destroy');
        });
        Route::prefix('en-report')->group(function () {
            Route::get('/', [ReportController::class, 'indexEn'])->name('report_management_en.index');
            Route::get('{code}', [ReportController::class, 'indexInternational'])->name('conference_en_report.index');
            Route::get('{code}/edit/{id}', [ReportController::class, 'editInternational'])->name('conference_en_report.edit');
            Route::post('{code}/update', [ReportController::class, 'updateInternational'])->name('conference_en_report.update');
            Route::delete('delete/{id}', [ReportController::class, 'destroyInternational'])->name('conference_en_report.destroy');
        });
    });

    //Register Management
    Route::prefix('register-management')->group(function () {
        Route::prefix('register')->group(function () {
            Route::get('/', [RegisterController::class, 'index'])->name('register_management.index');
            Route::get('{code}', [RegisterController::class, 'indexNational'])->name('conference_register.index');
            Route::post('{code}/copy/{id}', [RegisterController::class, 'copy'])->name('conference_register.copy');
            Route::get('{code}/edit/{id}', [RegisterController::class, 'edit'])->name('conference_register.edit');
            Route::post('{code}/update', [RegisterController::class, 'update'])->name('conference_register.update');
            Route::delete('delete/{id}', [RegisterController::class, 'destroy'])->name('conference_register.destroy');
            Route::post('/import-excel', [ExcelController::class, 'import'])->name('import-excel');
        });
        Route::prefix('en-register')->group(function () {
            Route::get('/', [RegisterController::class, 'indexEn'])->name('register_management_en.index');
            Route::get('{code}', [RegisterController::class, 'indexInternational'])->name('conference_en_register.index');
            Route::get('{code}/edit/{id}', [RegisterController::class, 'editInternational'])->name('conference_en_register.edit');
            Route::post('{code}/update', [RegisterController::class, 'updateInternational'])->name('conference_en_register.update');
            Route::delete('delete/{id}', [RegisterController::class, 'destroyInternational'])->name('conference_en_register.destroy');
        });
        Route::prefix('vip')->group(function () {
            Route::get('/', [RegisterController::class, 'indexV'])->name('register_management_vip.index');
            Route::get('{code}', [RegisterController::class, 'indexVip'])->name('conference_vip_register.index');
            Route::get('{code}/edit/{id}', [RegisterController::class, 'editVip'])->name('conference_vip_register.edit');
            Route::post('{code}/update', [RegisterController::class, 'updateVip'])->name('conference_vip_register.update');
            Route::delete('delete/{id}', [RegisterController::class, 'destroyVip'])->name('conference_vip_register.destroy');
        });
    });

    Route::get('test-mail', function () {
        return view('mail.report.vart.accept')->with([
            'title' => 0,
            'name' => 'Dương',
            'code' => 'DVs',
            'conference_title' => 'Hội nghị Khoa học Kỹ Thuật Hình Ảnh Y Học Toàn Quốc lần thứ 13',
            'suggestedAddition' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'
        ]);
    });

    Route::prefix('conference')->group(function () {
        Route::get('/', [ConferenceController::class, 'index'])->name('conference.index');
        Route::post('load', [ConferenceController::class, 'load'])->name('conference.load');
        Route::post('get-form', [ConferenceController::class, 'getForm'])->name('conference.get_form');
        Route::post('create-or-update', [ConferenceController::class, 'storeOrUpdate'])->name('conference.store_or_update');
        Route::delete('delete', [ConferenceController::class, 'destroy'])->name('conference.destroy');
        //ConferenceFee
        Route::prefix('fee')->group(function () {
            Route::post('/', [ConferenceFeeController::class, 'index'])->name('conference_fee.index');
            Route::post('save-or-update', [ConferenceFeeController::class, 'storeOrUpdate'])->name('conference_fee.store_or_update');
            Route::delete('delete', [ConferenceFeeController::class, 'destroy'])->name('conference_fee.destroy');
        });
    });

    Route::prefix('album')->group(function () {
        Route::get('/', [AlbumController::class, 'index'])->name('album.index');
        Route::get('create', [AlbumController::class, 'create'])->name('album.create');
        Route::post('save', [AlbumController::class, 'store'])->name('album.store');
    });

    //Vart
    Route::prefix('vart')->group(function () {
        Route::get('/', [VartController::class, 'index'])->name('vart.index');
        Route::post('load', [VartController::class, 'load'])->name('vart.load');
        Route::post('get-form', [VartController::class, 'getForm'])->name('vart.get_form');
        Route::post('create-or-update', [VartController::class, 'storeOrUpdate'])->name('vart.store_or_update');
        Route::delete('delete', [VartController::class, 'destroy'])->name('vart.destroy');
    });

    //Hart
    Route::prefix('hart')->group(function () {
        Route::get('/', [HartController::class, 'index'])->name('hart.index');
        Route::post('load', [HartController::class, 'load'])->name('hart.load');
        Route::post('get-form', [HartController::class, 'getForm'])->name('hart.get_form');
        Route::post('create-or-update', [HartController::class, 'storeOrUpdate'])->name('hart.store_or_update');
        Route::delete('delete', [HartController::class, 'destroy'])->name('hart.destroy');
        Route::get('test-invoice', function () {
            $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'defaultFont' => 'sans-serif'])->loadView('pdf.receipt', [
                'name' => 'Huỳnh Quốc Dương',
                'phone' => '0943705326',
                'unit' => 'Medicen',
                'address' => '33,Phường 11,Thành phố Vũng Tàu,Tỉnh Bà Rịa - Vũng Tàu',
                'price' => '980.000₫',
                'conferenceFeeTitle' => 'Phí tham gia trực tuyến có cấp giấy chứng nhận CME	',
                "imgBackground" => parserImgPdf(choseInvoiceByConferenceType(2))
            ])->setPaper('a4', 'landscape');
            return $pdf->stream('invitation-letter-attendees.pdf');
        });
    });

    //Hrtta
    Route::prefix('hrtta')->group(function () {
        Route::get('/', [HrttaController::class, 'index'])->name('hrtta.index');
        Route::post('load', [HrttaController::class, 'load'])->name('hrtta.load');
        Route::post('get-form', [HrttaController::class, 'getForm'])->name('hrtta.get_form');
        Route::post('create-or-update', [HrttaController::class, 'storeOrUpdate'])->name('hrtta.store_or_update');
        Route::delete('delete', [HrttaController::class, 'destroy'])->name('hrtta.destroy');
    });

    //Vart
    // Route::prefix('hart')->group(function () {
    //     Route::get('/', [HartController::class, 'index'])->name('hart.index');
    //     Route::get('/create', [HartController::class, 'create'])->name('hart.create');
    //     Route::get('/edit/{id}', [HartController::class, 'edit'])->name('hart.edit');
    //     Route::get('/delete/{id}', [HartController::class, 'destroy'])->name('hart.destroy');
    //     Route::post('/save', [HartController::class, 'store'])->name('hart.store');
    //     Route::post('/update/{id}', [HartController::class, 'update'])->name('hart.update');
    //     Route::post('/load-hart-content', [HartController::class, 'loadHartContent'])->name('loadHartContent');
    //     Route::post('/add-hart-content', [HartController::class, 'createHartContent'])->name('createHartContent');
    //     Route::post('/update-hart-content', [HartController::class, 'updateHartContent'])->name('updateHartContent');
    //     Route::delete('/delete-hart-content/{id}', [HartController::class, 'destroyHartContent'])->name('destroyHartContent');
    // });

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

   //Blog Category
    Route::prefix('blog-category')->group(function () {
        Route::get('/', [BlogCategoryController::class, 'index'])->name('blog_category.index');
        Route::post('load', [BlogCategoryController::class, 'load'])->name('blog_category.load');
        Route::post('get-form', [BlogCategoryController::class, 'getForm'])->name('blog_category.get_form');
        Route::post('create-or-update', [BlogCategoryController::class, 'storeOrUpdate'])->name('blog_category.store_or_update');
        Route::delete('delete', [BlogCategoryController::class, 'destroy'])->name('blog_category.destroy');
    });

    //Blog
    Route::prefix('blog')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('blog.index');
        Route::post('load', [BlogController::class, 'load'])->name('blog.load');
        Route::post('get-form', [BlogController::class, 'getForm'])->name('blog.get_form');
        Route::post('create-or-update', [BlogController::class, 'storeOrUpdate'])->name('blog.store_or_update');
        Route::delete('delete', [BlogController::class, 'destroy'])->name('blog.destroy');
    });
});



// Invitation
Route::prefix('invitation')->group(function () {
    Route::get('/', [InvitationController::class, 'index'])->name('invitation.index');
    Route::get('{code}', [InvitationController::class, 'indexDetails'])->name('invitation.index_details');
});

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
