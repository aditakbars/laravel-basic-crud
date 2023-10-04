<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
Route::get('/', [AdminController::class, 'index'])->name('admin.index');
Route::get('ice-creams', [AdminController::class, 'showIce'])->name('admin.showIce');
Route::get('suppliers', [AdminController::class, 'showSup'])->name('admin.showSup');
Route::get('ice-creams/add', [AdminController::class, 'create'])->name('admin.create');
Route::get('suppliers/add', [AdminController::class, 'createSup'])->name('admin.createSup');
Route::post('ice-creams/store', [AdminController::class, 'store'])->name('admin.store');
Route::post('suppliers/store', [AdminController::class, 'storeSup'])->name('admin.storeSup');
Route::get('ice-creams/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::post('ice-creams/update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::get('suppliers/edit/{id}', [AdminController::class, 'editSup'])->name('admin.editSup');
Route::post('suppliers/update/{id}', [AdminController::class, 'updateSup'])->name('admin.updateSup');
Route::post('ice-creams/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
Route::post('suppliers/delete/{id}', [AdminController::class, 'deleteSUp'])->name('admin.deleteSup');
