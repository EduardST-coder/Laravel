<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Observers\BlogPostObserver;
use App\Observers\BlogCategoryObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Якщо потрібно — для сумісності з MySQL < 5.7
        Schema::defaultStringLength(191);

        // Підключення обсерверів
        BlogPost::observe(BlogPostObserver::class);
        BlogCategory::observe(BlogCategoryObserver::class);
    }
}
