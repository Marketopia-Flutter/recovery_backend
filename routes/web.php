<?php

use Illuminate\Support\Facades\Route;
use App\Models\Setting;
use App\Models\Customer;

Route::get('/', function () {
    return redirect('/admin');
});
