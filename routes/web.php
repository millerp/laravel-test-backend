<?php

use App\Http\Controllers\ImovelController;
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


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('imoveis', [ImovelController::class, 'index'])->name('imoveis.index');
    Route::get('imoveis/create', [ImovelController::class, 'create'])->name('imoveis.create');
    Route::post('imoveis', [ImovelController::class, 'store'])->name('imoveis.store');
    Route::delete('imoveis/{imovel}', [ImovelController::class, 'destroy'])->name('imoveis.destroy');
});
