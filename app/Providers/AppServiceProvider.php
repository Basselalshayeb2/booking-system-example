<?php

namespace App\Providers;

use App\Http\Services\BookingService;
use App\Http\Services\ResourceService;
use App\Models\Booking;
use App\Observers\BookingObserver;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
        //
        Booking::observe(BookingObserver::class);
        Response::macro('success', function ($data) {
            return response()->json([
                'data' => $data,
                'status' => 'success',
                'code' => ResponseAlias::HTTP_OK,
            ], ResponseAlias::HTTP_OK);
        });
        Response::macro('error', function ($msg, $code = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR) {
            return response()->json([
                'message' => $msg,
                'status' => 'error',
                'code' => $code,
            ], $code);
        });

        // Repositories bindings

        // Singleton Services : No need for this service
        //        App::singleton(BookingService::class, function ($app) {
        //            return new BookingService();
        //        });
        //
        //        App::singleton(ResourceService::class, function ($app) {
        //            return new ResourceService();
        //        });
    }
}
