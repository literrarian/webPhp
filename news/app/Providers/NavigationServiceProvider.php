<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Rubric;
use Illuminate\Support\Facades\View;
class NavigationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */

    public function boot()
    {
        View::composer('*', function ($view) {
            $rubrics = Rubric::all();

            $view->with('rubrics', $rubrics);
        });
    }

}
