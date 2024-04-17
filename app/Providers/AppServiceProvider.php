<?php

namespace App\Providers;
use App\Models\Hart;
use App\Models\BlogCategory;
use App\Models\ConferenceCategory;
use App\Models\Vart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view) {
            $getAllVart = Vart::orderBy('vart_id','ASC')->get();
		    $getAllHart = Hart::orderBy('hart_id','ASC')->get();
            $getAllConferenceCategory = ConferenceCategory::orderBy('conference_category_id','ASC')->get();
            $getAllBlogCategory = BlogCategory::orderBy('blog_category_id','ASC')->get();
            $view->with(compact('getAllVart','getAllHart','getAllConferenceCategory','getAllBlogCategory'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
