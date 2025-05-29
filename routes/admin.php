<?php

use Illuminate\Support\Facades\Route;
use Taq\Tqadmtpl\Http\Controllers\UserController as AdmUser;

Route::middleware(['web','auth:admin'])
    ->name('tqadm.')->prefix('tqadm')
    ->group(function(){
        Route::prefix('api')->name('api.')->group(function () {
            Route::get('/users', [AdmUser::class, 'index'])->name('users');
            Route::get('/user/{id}', [AdmUser::class, 'show'])->name('user');
            Route::post('/user/{id}/info', [AdmUser::class, 'updateInfo']);
            Route::get('/user/{id}/memos', [AdmUser::class, 'memoList']);
            Route::post('/user/{id}/memo', [AdmUser::class, 'saveMemo']);
            Route::post('/user/{id}/pwd', [AdmUser::class, 'updatePassword']);

            Route::get('/user/{id}/point', [AdmUser::class, 'pointList']);
            Route::post('/user/{id}/point', [AdmUser::class, 'storePoint']);
        });
});
