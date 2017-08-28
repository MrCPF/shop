<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Cart;
use View;
use Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $count = Cart::count();
        $count = empty($_SESSION['count']) ? 0 : $_SESSION['count'];
        $search = empty($_REQUEST['search']) ? '' : $_REQUEST['search'];
//        $count = '2132';
        View::share('count',$count);
        View::share('search',$search);
        //给指定模板共享变量
        /*View::composer(['layouts.art','art.index'],function($view) {
            $view->with('nav','php186');
        });*/
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
