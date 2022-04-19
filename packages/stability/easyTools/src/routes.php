<?php

use Stability\EasyTools\JobDetailController;

Route::get('packagetest', function () {
    return "this is visible from easytoolservice package";
});
Route::get('/', function () {
    return view('stability::job-detail');
});
Route::get('/job-detail', [JobDetailController::class, 'index'])->name('job-detail.index');
Route::delete('/job-detail/{jId}', [JobDetailController::class, 'destroy'])->name('job-detail.destroy');
Route::delete('/job-detailDeleteSelected', [JobDetailController::class, 'deleteSelected']);
