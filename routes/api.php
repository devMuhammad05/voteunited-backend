<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\UpvoteController;
use App\Http\Controllers\Api\DownvoteController;
use App\Http\Controllers\Api\Auth\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/', function (Request $request) {
    return response()->json([
        "message" => "Api is active"
    ]);
});

Route::post('auth/login', [AuthController::class, 'loginWithGoogle'])->middleware('throttle:5,1');
Route::get('members', [MemberController::class, 'index']);
Route::get('members/{id}', [MemberController::class, 'show']);
Route::post('upvote-member', UpvoteController::class);
Route::post('downvote-member', DownvoteController::class);

