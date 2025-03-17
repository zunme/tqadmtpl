<?php

use Illuminate\Support\Facades\Route;
use Taq\Tqforms\Http\Controllers\FilepondController;
Route::get('/tqadmsample/1', function () {
    return view('tqadmtpl::sample');
})->name('tqadmsample.test1');
Route::get('/tqadmsample/2', function () {
    return view('tqadmtpl::sample');
})->name('tqadmsample.test2');
