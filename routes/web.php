<?php

use Illuminate\Support\Facades\Route;
use Taq\Tqforms\Http\Controllers\FilepondController;
Route::middleware(['web','auth:admin'])
    ->name('tqadmsample.')->prefix('tqadmsample')
    ->group(function(){
        Route::get('sample', function () {
            return view('tqadmtpl::sample');
        })->name('sample');
        Route::get('users', function () {
            return view('tqadmtpl::users');
        })->name('users');
        Route::get('test', function () {
            return view('tqadmtpl::sample');
        })->name('test');
});
