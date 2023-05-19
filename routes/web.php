<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParticipantController;

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

Route::get('/', 'SchoolarshipController@index');

Route::resource('schoolarship', 'SchoolarshipController');
Route::resource('dashboard', 'ParticipantController');
Route::post('/add', [ParticipantController::class, 'add'])->name('dashboard.add');
