<?php

namespace App\Providers;

use App\Category;
use Thujohn\Twitter\Facades\Twitter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function ($view){
            $view->with('sidebarCategories', \App\Category::has('bookmarks')->get());
            $view->with('categories', \App\Category::pluck('name', 'id')->all());
            $view->with('tweets' , Twitter::getUserTimeline(['count' => 5, 'format' => 'array']));
        });

        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
