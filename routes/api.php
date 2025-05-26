<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdmUser;


Route::middleware(['web','auth:admin'])->prefix('admin')->group(function () {
    Route::get('/users', [AdmUser::class, 'index'])->name('users');
    Route::get('/user/{id}', [AdmUser::class, 'show'])->name('user');
    //Route::get('/users', [AdmUser::class, 'list'])->middleware(['permission:view_any_user']);
})->name('admin.');