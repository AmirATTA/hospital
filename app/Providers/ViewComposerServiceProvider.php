<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use App\Helpers\Helpers;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function boot()
    {
        view()->composer('layouts.admin.master', function ($view) {
            $notifications = Notification::all();
            $logo = Helpers::setting('logo', asset('assets/images/hospital_logo.png'));
            $view->with(compact('notifications','logo'));
        });
    }

    public function register()
    {
        //
    }
}
