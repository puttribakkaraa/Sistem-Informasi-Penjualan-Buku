<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $notifikasi = $user->notifications;
                $notifikasiUnread = $user->unreadNotifications;
            } else {
                $notifikasi = collect();
                $notifikasiUnread = collect();
            }

            $view->with('notifikasi', $notifikasi)
                 ->with('notifikasiUnread', $notifikasiUnread);
        });
    }
}
