<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('records', [RecordController::class, 'show']);
Route::get('record/{id}', [RecordController::class, 'showById']);
Route::post('record', [RecordController::class, 'store']);
Route::get('comments', [CommentController::class, 'getComments']);
Route::post('comment', [CommentController::class, 'store']);