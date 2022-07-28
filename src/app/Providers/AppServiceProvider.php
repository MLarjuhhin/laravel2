<?php

namespace App\Providers;

use App\Models\BlogCategoty;
use App\Models\BlogPost;

use App\Observers\BlogCategoryObserver;
use App\Observers\BlogPostObserver;

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
//        BlogPost::observe(BlogPostObserver::class);
//        BlogCategoty::observe(BlogCategoryObserver::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        BlogPost::observe(BlogPostObserver::class);
        BlogCategoty::observe(BlogCategoryObserver::class);
    }
}
