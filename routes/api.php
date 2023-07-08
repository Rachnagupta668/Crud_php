<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//public routes

Route::get('/register',[UserController::class,'register']);
//protected routes


