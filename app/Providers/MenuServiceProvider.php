<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Composers\MenuComposer;
use App\Http\Composers\FooterMenuComposer;

class MenuServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('frontend.layouts.header-menu', MenuComposer::class);
        View::composer('frontend.layouts.footer', FooterMenuComposer::class);
    }

    public function register()
    {
        //
    }
}
