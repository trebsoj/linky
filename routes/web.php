<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\VariableController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LinkController::class, 'index'])->middleware('auth')->name('home');

Route::resources(
    [
        'link' => LinkController::class,
        'group' => GroupController::class,
        'variable' => VariableController::class,
    ],
    [
        'middleware' => ['auth']
    ]
);


Route::get('/public', [LinkController::class, 'indexPublic'])->name('public.index');
Route::get('/r/{code}', [LinkController::class, 'redirect'])->name('redirect');
Route::get('/public/group/{group}', [GroupController::class, 'showPublic'])->name('public.group.show');
Route::get('/group/{group}/random', [GroupController::class, 'random'])->name('group.random');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Auth::routes();

