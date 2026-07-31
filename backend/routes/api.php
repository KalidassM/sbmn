<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\CommitteeMemberController;
use App\Http\Controllers\Api\ContactMessageController;

Route::post('/login',[AuthController::class,'login']);
Route::post('/contact-messages',[ContactMessageController::class,'store']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/me',[AuthController::class,'me']);
});

Route::get('/dashboard',[DashboardController::class,'index']);
Route::apiResource('members',MemberController::class);
Route::apiResource('payments',PaymentController::class);
Route::apiResource('expenses',ExpenseController::class);

Route::get('notices',[NoticeController::class,'index']);
Route::get('events',[EventController::class,'index']);
Route::get('committee-members',[CommitteeMemberController::class,'index']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('notices',NoticeController::class)->except('index');
    Route::apiResource('events',EventController::class)->except('index');
    Route::apiResource('committee-members',CommitteeMemberController::class)
        ->parameter('committee-members','committee_member')
        ->except('index');
});
