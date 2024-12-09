<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\File_featureController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResources([
    '/ui' => UiController::class,
]);
Route::apiResources([
    '/category' => CategoryController::class,
    '/feature' => FeatureController::class,
    '/file_feature' => File_featureController::class,
    '/file' => FileController::class,
    '/user' => UserController::class,
    '/image' => ImageController::class,
    '/comment'=> CommentController::class
]);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    //Route::post('verify', [AuthController::class, 'verify']);
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::post('verify', [UserController::class, 'verify']);
});
