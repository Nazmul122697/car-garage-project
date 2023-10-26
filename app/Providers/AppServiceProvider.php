<?php

namespace App\Providers;

use App\Models\Website;
use App\Models\NatureOfCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $view->with('website', Website::first());
            $view->with('natures', NatureOfCompany::orderBy('name','asc')->get());
        });

        Blade::directive('formatdate', function ($expression) {
            return "<?php echo (new \Datetime($expression))->format('d-M-Y'); ?>";
        });

    }
}
