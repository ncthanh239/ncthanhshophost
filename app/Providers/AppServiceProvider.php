<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;
use App\Size;
use App\Color;
use App\SubCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(!\App::runningInConsole()){
            View::share('categories', Category::all());
        }
        if(!\App::runningInConsole()){
            View::share('subcategories', SubCategory::all());
        }
         if(!\App::runningInConsole()){
            View::share('sizes', Size::all());
        }
         if(!\App::runningInConsole()){
            View::share('colors', Color::all());
        }
        // Schema::defaultStringLength(191);
    }
}
