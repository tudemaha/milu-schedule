<?php

use App\Http\Controllers\RecapController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Form;
use App\Livewire\SetPassword;

Route::get('/', Form::class);
Route::get('/set-password', SetPassword::class);
Route::view('/success', 'success');
Route::get('/recap', [RecapController::class, 'index']);
