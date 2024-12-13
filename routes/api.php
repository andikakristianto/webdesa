<?php

use App\Http\Controllers\API\AKTEadminAPI;
use App\Http\Controllers\API\AKTEuserAPI;
use App\Http\Controllers\API\Berita\BeritaAPI;
use App\Http\Controllers\API\Berita\CategoryAPI;
use App\Http\Controllers\API\KKadminAPI;
use App\Http\Controllers\API\KKuserAPI;
use App\Http\Controllers\API\KTPadminAPI;
use App\Http\Controllers\API\KTPuserAPI;
use App\Http\Controllers\API\MasyarakatAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::get('user', [MasyarakatAPI::class, 'index']);
Route::get('category', [CategoryAPI::class, 'index']);
Route::get('berita', [BeritaAPI::class, 'index']);



// Admin
Route::get('/kk', [KKadminAPI::class, 'index']);
Route::get('/ktp', [KTPadminAPI::class, 'index']);
Route::get('/akte', [AKTEadminAPI::class, 'index']);
