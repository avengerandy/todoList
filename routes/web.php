<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', [TodoController::class, 'index']);
Route::get('create', [TodoController::class, 'create']);
Route::get('detail/{todo}', [TodoController::class, 'detail']);
Route::get('edit/{todo}', [TodoController::class, 'edit']);

Route::post('createAction', [TodoController::class, 'createAction']);
Route::post('update/{todo}', [TodoController::class, 'update']);
Route::post('delete/{todo}', [TodoController::class, 'delete']);
