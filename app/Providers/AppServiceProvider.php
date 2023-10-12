<?php

namespace App\Providers;

use App\Models\Models\Category;
use App\Models\Models\Shipping_States;
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
        //
        $data['listcategories']= Category::all();
        // $data['shippingstates'] = Shipping_States::all();
        view()->share($data);
    }
}
