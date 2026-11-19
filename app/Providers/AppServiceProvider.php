<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Berita;

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
        View::composer('layout.app', function($view) {
            $recentNews = Berita::orderBy('tgl', 'desc')->take(5)->get();
            $view->with('recentNews', $recentNews);
        });
    }
}
