<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;

//Rota 401 - Quando o usuário tentar acessar algo sem estar logado ele é redirecionado para essa rota
Route::get('/401', [AuthController::class, 'unauthorized'])->name('login'); 

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/profile', [ProfileController::class, 'showProfile']);
Route::post('/profile/avatar', [ProfileController::class, 'addAvatar']);
Route::get('/profile/avatar', [ProfileController::class, 'removeAvatar']);

Route::post('/notes', [NoteController::class, 'register']);
Route::get('/notes/{id}', [NoteController::class, 'findById']);
Route::get('/notes/{search?}', [NoteController::class, 'findAll']);
Route::put('/notes/{id}', [NoteController::class, 'update']);
Route::delete('/notes/{id}', [NoteController::class, 'delete']);

Route::get('/users', [UserController::class, 'findAllUsers']);