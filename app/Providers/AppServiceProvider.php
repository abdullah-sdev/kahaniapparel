<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use View;

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
        //

        View::composer('layouts.kahani', function ($view) {
            $categories = Category::select('id', 'name', 'slug', 'image')->limit('4')->get();

            $view->with('navcategories', $categories);

            // dd($view);
        });
        // View::composer('kahani-apparel.layouts.kahani', function ($view) {
        //     // $data = YourModel::all(); // or any other query
        //     $categories = Category::select('id', 'name', 'slug', 'image')->limit('4')->get();

        //     $view->with('navbarData', $categories);
        // });

        // env local then prevent lazy loading
        if (app()->environment('local')) {
            Model::preventLazyLoading();
        }
    }
}
