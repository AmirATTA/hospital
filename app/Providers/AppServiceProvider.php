<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    private function responseMacros()
    {
        Response::macro('success', function ($message, array $data = null, $httpCode = 200) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data
            ], $httpCode);
        });
    
        Response::macro('error', function ($message, array $data = null, $httpCode = 400) {
    
            //validation error
            if ($httpCode == 422){
                return response()->json([
                    'success' => false,
                    'message' => $message,
                    'errors' => $data
                ], $httpCode);
    
            }
            return response()->json([
                'success' => false,
                'message' => $message,
                'data' => $data
            ] ,$httpCode);
    
        });
    }

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
        $this->responseMacros();

        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()

        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });
    }
}
