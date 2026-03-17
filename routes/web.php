<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;

Route::get('/', function () {
    return redirect()->route('grades.index');
});

Route::resource('grades', GradeController::class);