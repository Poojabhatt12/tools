<?php

use Stability\EasyTools\Controllers\JobDetailController;

Route::get('/', function () {
    return view('main');
});
Route::get('/job-detail', [JobDetailController::class, 'index'])->name('job-detail.index');
Route::delete('/job-detail/{jobDetail}', [JobDetailController::class, 'destroy'])->name('job-detail.destroy');
Route::delete('/job-detailDeleteSelected', [JobDetailController::class, 'deleteSelected']);
