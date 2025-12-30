<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Response::macro('api', function ($status = 200, $data = null, $message = null) {
            return response()->json([
                'success' => $status >= 200 && $status < 300,
                'status' => $status,
                'message' => $message,
                'data' => $data,
            ], $status);
        });
    }
}
