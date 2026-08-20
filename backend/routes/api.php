<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SavedSearchController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleFeatureController;
use App\Http\Controllers\VehicleImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->post('/vehicles', [VehicleController::class, 'store']);

Route::middleware('auth:sanctum')->put('/vehicles/{vehicle}', [VehicleController::class, 'update']);

Route::middleware('auth:sanctum')->delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy']);

Route::get('/vehicles', [VehicleController::class, 'index']);

Route::get('/vehicles/{vehicle}', [VehicleController::class, 'show']);

Route::middleware('auth:sanctum')->post('/vehicles/{vehicle}/images', [VehicleImageController::class, 'store']);

Route::middleware('auth:sanctum')->delete('/vehicles/{vehicle}/images/{image}', [VehicleImageController::class, 'delete']);

Route::middleware('auth:sanctum')->post('/vehicles/{vehicle}/features', [VehicleFeatureController::class, 'atachFeature']);

Route::middleware('auth:sanctum')->delete('/vehicles/{vehicle}/features/{feature}', [VehicleFeatureController::class, 'detachFeature']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/vehicles/{vehicle}/favorite', [FavoriteController::class, 'store']);

    Route::delete('/vehicles/{vehicle}/favorite', [FavoriteController::class, 'destroy']);

    Route::get('/favorites', [FavoriteController::class, 'index']);
});

Route::middleware('auth:sanctum')->post('/saved-searches', [SavedSearchController::class, 'store']);

Route::middleware('auth:sanctum')->get('/saved-searches', [SavedSearchController::class, 'index']);

Route::middleware('auth:sanctum')->delete('/saved-searches/{savedSearch}', [SavedSearchController::class, 'destroy']);

Route::middleware('auth:sanctum')->post('/vehicles/{vehicle}/reports', [ReportController::class, 'store']);

Route::middleware('auth:sanctum')->get('/my-reports', [ReportController::class, 'index']);

Route::middleware('auth:sanctum')->get('/my-reports/{report}', [ReportController::class, 'show']);

Route::middleware('auth:sanctum')->post('/users/{user}/review', [ReviewController::class, 'store']);

Route::middleware('auth:sanctum')->put('/my-reviews/{review}',[ReviewController::class, 'update']);

Route::middleware('auth:sanctum')->get('/my-reviews',[ReviewController::class, 'reviewerIndex']);

Route::middleware('auth:sanctum')->get('/my-reviews/received',[ReviewController::class, 'reviewedUserIndex']);

Route::middleware('auth:sanctum')->get('/my-reviews/rate',[ReviewController::class, 'getRating']);

Route::middleware('auth:sanctum')->delete('/my-reviews/{review}',[ReviewController::class, 'destroy']);

Route::middleware('auth:sanctum')->get('/my-conversations',[ConversationController::class,'index']);

Route::middleware('auth:sanctum')->get('/conversations/{conversation}',[ConversationController::class,'show']);

Route::middleware('auth:sanctum')->delete('/conversations/{conversation}',[ConversationController::class,'destroy']);

Route::middleware('auth:sanctum')->put('/conversations/{conversation}/messages/{message}',[MessageController::class, 'update']);

Route::middleware('auth:sanctum')->post('/vehicles/{vehicle}/message',[MessageController::class,'store']);

Route::middleware('auth:sanctum')->post('/conversations/{conversation}/message',[MessageController::class,'send']);

Route::middleware('auth:sanctum')->delete('/conversations/{conversation}/messages/{message}',[MessageController::class,'destroy']);

Route::get('/user', function (Request $request) {
return $request->user();
})->middleware('auth:sanctum');
