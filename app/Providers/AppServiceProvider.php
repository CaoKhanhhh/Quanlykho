<?php

namespace App\Providers;
use App\Notifications;
use App\Product;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
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
        View::composer('admin.form_assignQuankho',function($view){
            $user_assign=User::where('role','=',2)->get();
            $view->with('user_assign',$user_assign);
        });
        View::composer('admin.quankho_view',function($view){
            $notifications=Notifications::all();
            $view->with('notifications',$notifications);
        });
    }
}
