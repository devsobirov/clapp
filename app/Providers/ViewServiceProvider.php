<?php

namespace App\Providers;

use App\View\Composers\CategoryComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CategoryComposer::class);
    }

    public function boot(): void
    {
        View::composer('*', CategoryComposer::class);
    }
}
