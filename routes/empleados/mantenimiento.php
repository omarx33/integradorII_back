<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('mantenimiento')->group(function () {


    Route::resource('usuarios',UserController::class);

});




?>
