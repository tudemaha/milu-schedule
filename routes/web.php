<?php

use App\Http\Controllers\RecapController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Form;

Route::get('/', Form::class);
Route::view('/success', 'success');
Route::get('/recap', [RecapController::class, 'index']);
