<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use App\Models\Employer;

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
        Paginator::useBootstrap();
        $employer=Employer::all();
        View::share('employer',$employer);

        
    }
}
