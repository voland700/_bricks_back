<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Кэш очищен.";
})->name('clear.cash');


Route::post('/admin/masters-import', [App\Http\Controllers\Admin\Import\ImportController::class, 'importMasters'])->name('import.masters');


Route::get('/', [App\Http\Controllers\Front\IndexController::class, 'index'])->name('index');

Route::get('/masters', [App\Http\Controllers\Front\MasterController::class, 'index'])->name('master.index');
Route::get('/master/{slug}', [App\Http\Controllers\Front\MasterController::class, 'master'])->name('master.item');

// routs Modify Data - dell
Route::get('/modify-add-locations', [App\Http\Controllers\Admin\ModifyController::class, 'addlocations']);

Route::get('/test', [App\Http\Controllers\Front\TestController::class, 'test']);

