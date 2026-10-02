    <?php

    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\AdminLookupController;
    use App\Http\Controllers\AdminSettingsController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\ConversationController;
    use App\Http\Controllers\DashboardController;
    use App\Http\Controllers\FavoriteController;
    use App\Http\Controllers\MessageController;
    use App\Http\Controllers\NotificationController;
    use App\Http\Controllers\ReportController;
    use App\Http\Controllers\ReviewController;
    use App\Http\Controllers\SavedSearchController;
    use App\Http\Controllers\VehicleController;
    use App\Http\Controllers\VehicleFeatureController;
    use App\Http\Controllers\VehicleImageController;
    use App\Http\Controllers\ProfileController;
    use App\Http\Controllers\SettingsController;
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

    Route::middleware('auth:sanctum')->post('/saved_searches', [SavedSearchController::class, 'store']);

    Route::middleware('auth:sanctum')->get('/saved_searches', [SavedSearchController::class, 'index']);

    Route::middleware('auth:sanctum')->delete('/saved_searches/{savedSearch}', [SavedSearchController::class, 'destroy']);

    Route::middleware('auth:sanctum')->post('/vehicles/{vehicle}/report', [ReportController::class, 'store']);

    Route::middleware('auth:sanctum')->get('/my_reports', [ReportController::class, 'index']);

    Route::middleware('auth:sanctum')->post('/users/{user}/review', [ReviewController::class, 'store']);

    Route::middleware('auth:sanctum')->put('/my_reviews/{review}', [ReviewController::class, 'update']);

    Route::middleware('auth:sanctum')->get('/my_reviews', [ReviewController::class, 'reviewerIndex']);

    Route::middleware('auth:sanctum')->get('/my_reviews/received', [ReviewController::class, 'reviewedUserIndex']);

    Route::middleware('auth:sanctum')->get('/my_reviews/rate', [ReviewController::class, 'getRating']);

    Route::middleware('auth:sanctum')->delete('/my_reviews/{review}', [ReviewController::class, 'destroy']);

    Route::middleware('auth:sanctum')->get('/my_conversations', [ConversationController::class, 'index']);

    Route::middleware('auth:sanctum')->get('/conversations/{conversation}', [ConversationController::class, 'show']);

    Route::middleware('auth:sanctum')->delete('/conversations/{conversation}', [ConversationController::class, 'destroy']);

    Route::middleware('auth:sanctum')->put('/conversations/{conversation}/messages/{message}', [MessageController::class, 'update']);

    Route::middleware('auth:sanctum')->post('/vehicles/{vehicle}/message', [MessageController::class, 'store']);

    Route::middleware('auth:sanctum')->post('/conversations/{conversation}/message', [MessageController::class, 'send']);

    Route::middleware('auth:sanctum')->delete('/conversations/{conversation}/messages/{message}', [MessageController::class, 'destroy']);

    Route::middleware('auth:sanctum')->get('/profile', [ProfileController::class, 'show']);

    Route::middleware('auth:sanctum')->put('/profile', [ProfileController::class, 'update']);

    Route::middleware('auth:sanctum')->get('/overview', [DashboardController::class, 'index']);

    Route::middleware('auth:sanctum')->get('/my_listings', [DashboardController::class, 'myListings']);

    Route::middleware('auth:sanctum')->put('/settings/password', [SettingsController::class, 'changePassword']);

    Route::middleware('auth:sanctum')->get('/settings/preferences', [SettingsController::class, 'getPreferences']);

    Route::middleware('auth:sanctum')->put('/settings/preferences', [SettingsController::class, 'updatePreferences']);

    Route::middleware('auth:sanctum')->put('/settings/privacy/phone', [SettingsController::class, 'togglePhoneNumberVisibility']);

    Route::middleware('auth:sanctum')->delete('/settings/delete_account', [SettingsController::class, 'deleteAccount']);

    Route::middleware('auth:sanctum')->get('/settings/notifications', [SettingsController::class, 'getNotificationSettings']);

Route::middleware('auth:sanctum')->put('/settings/notifications', [SettingsController::class, 'updateNotificationSettings']);

    Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
        Route::get('/overview', [AdminController::class, 'overview']);
        Route::get('/users', [AdminController::class, 'users']);
        Route::put('/users/{user}/block', [AdminController::class, 'blockUser']);
        Route::put('/users/{user}/unblock', [AdminController::class, 'unblockUser']);
        Route::delete('users/{user}/delete', [AdminController::class, 'deleteUser']);
        Route::put('/users/{user}/verify', [AdminController::class, 'verifyUser']);
        Route::put('/users/{user}/unverify', [AdminController::class, 'unverifyUser']);
        Route::get('/listings', [AdminController::class, 'listings']);
        Route::get('/listings/{vehicle}', [AdminController::class, 'visitListing']);
        Route::put('/listings/{vehicle}/approve', [AdminController::class, 'approveListing']);
        Route::put('/listings/{vehicle}/reject', [AdminController::class, 'rejectListing']);
        Route::delete('/listings/{vehicle}', [AdminController::class, 'deleteListing']);
        Route::get('/reports', [AdminController::class, 'reports']);
        Route::put('/reports/{report}/review', [AdminController::class, 'reviewReport']);
        Route::put('/reports/{report}/resolve', [AdminController::class, 'resolveReport']);
        Route::put('/reports/{report}/reject', [AdminController::class, 'rejectReport']);
        Route::get('/lookups/brands', [AdminLookupController::class, 'brands']);
        Route::post('/lookups/brands', [AdminLookupController::class, 'storeBrand']);
        Route::put('/lookups/brands/{brand}', [AdminLookupController::class, 'updateBrand']);
        Route::delete('/lookups/brands/{brand}', [AdminLookupController::class, 'deleteBrand']);
        Route::get('/lookups/models', [AdminLookupController::class, 'models']);
        Route::post('/lookups/models', [AdminLookupController::class, 'storeModel']);
        Route::put('/lookups/models/{vehicleModel}', [AdminLookupController::class, 'updateModel']);
        Route::delete('/lookups/models/{model}', [AdminLookupController::class, 'deleteModel']);
        Route::get('/lookups/vehicle_types', [AdminLookupController::class, 'vehicleTypes']);
        Route::post('/lookups/vehicle_types', [AdminLookupController::class, 'storeVehicleType']);
        Route::put('/lookups/vehicle_types/{vehicleType}', [AdminLookupController::class, 'updateVehicleType']);
        Route::delete('/lookups/vehicle_types/{vehicleType}', [AdminLookupController::class, 'deleteVehicleType']);
        Route::get('/lookups/fuel_types', [AdminLookupController::class, 'fuelTypes']);
        Route::post('/lookups/fuel_types', [AdminLookupController::class, 'storeFuelType']);
        Route::put('/lookups/fuel_types/{fuelType}', [AdminLookupController::class, 'updateFuelType']);
        Route::delete('/lookups/fuel_types/{fuelType}', [AdminLookupController::class, 'deleteFuelType']);
        Route::get('/lookups/transmissions', [AdminLookupController::class, 'transmissions']);
        Route::post('/lookups/transmissions', [AdminLookupController::class, 'storeTransmission']);
        Route::put('/lookups/transmissions/{transmission}', [AdminLookupController::class, 'updateTransmission']);
        Route::delete('/lookups/transmissions/{transmission}', [AdminLookupController::class, 'deleteTransmission']);
        Route::get('/lookups/drivetrains', [AdminLookupController::class, 'drivetrains']);
        Route::post('/lookups/drivetrains', [AdminLookupController::class, 'storeDrivetrain']);
        Route::put('/lookups/drivetrains/{drivetrain}', [AdminLookupController::class, 'updateDrivetrain']);
        Route::delete('/lookups/drivetrains/{drivetrain}', [AdminLookupController::class, 'deleteDrivetrain']);
        Route::get('/lookups/body_types', [AdminLookupController::class, 'bodyTypes']);
        Route::post('/lookups/body_types', [AdminLookupController::class, 'storeBodyType']);
        Route::put('/lookups/body_types/{bodyType}', [AdminLookupController::class, 'updateBodyType']);
        Route::delete('/lookups/body_types/{bodyType}', [AdminLookupController::class, 'deleteBodyType']);
        Route::get('/lookups/colors', [AdminLookupController::class, 'colors']);
        Route::post('/lookups/colors', [AdminLookupController::class, 'storeColor']);
        Route::put('/lookups/colors/{color}', [AdminLookupController::class, 'updateColor']);
        Route::delete('/lookups/colors/{color}', [AdminLookupController::class, 'deleteColor']);
        Route::get('/lookups/conditions', [AdminLookupController::class, 'conditions']);
        Route::post('/lookups/conditions', [AdminLookupController::class, 'storeCondition']);
        Route::put('/lookups/conditions/{condition}', [AdminLookupController::class, 'updateCondition']);
        Route::delete('/lookups/conditions/{condition}', [AdminLookupController::class, 'deleteCondition']);
        Route::get('/lookups/engine_cylinders', [AdminLookupController::class, 'engineCylinders']);
        Route::post('/lookups/engine_cylinders', [AdminLookupController::class, 'storeEngineCylinder']);
        Route::put('/lookups/engine_cylinders/{engineCylinder}', [AdminLookupController::class, 'updateEngineCylinder']);
        Route::delete('/lookups/engine_cylinders/{engineCylinder}', [AdminLookupController::class, 'deleteEngineCylinder']);
        Route::get('/lookups/engine_layouts', [AdminLookupController::class, 'engineLayouts']);
        Route::post('/lookups/engine_layouts', [AdminLookupController::class, 'storeEngineLayout']);
        Route::put('/lookups/engine_layouts/{engineLayout}', [AdminLookupController::class, 'updateEngineLayout']);
        Route::delete('/lookups/engine_layouts/{engineLayout}', [AdminLookupController::class, 'deleteEngineLayout']);
        Route::get('/lookups/aspirations', [AdminLookupController::class, 'aspirations']);
        Route::post('/lookups/aspirations', [AdminLookupController::class, 'storeAspiration']);
        Route::put('/lookups/aspirations/{aspiration}', [AdminLookupController::class, 'updateAspiration']);
        Route::delete('/lookups/aspirations/{aspiration}', [AdminLookupController::class, 'deleteAspiration']);
        Route::get('/lookups/vehicle_generations', [AdminLookupController::class, 'generations']);
        Route::post('/lookups/vehicle_generations', [AdminLookupController::class, 'storeGeneration']);
        Route::put('/lookups/vehicle_generations/{vehicleGen}', [AdminLookupController::class, 'updateGeneration']);
        Route::delete('/lookups/vehicle_generations/{vehicleGen}', [AdminLookupController::class, 'deleteGeneration']);
        Route::get('/lookups/countries', [AdminLookupController::class, 'countries']);
        Route::post('/lookups/countries', [AdminLookupController::class, 'storeCountry']);
        Route::put('/lookups/countries/{country}', [AdminLookupController::class, 'updateCountry']);
        Route::delete('/lookups/countries/{country}', [AdminLookupController::class, 'deleteCountry']);
        Route::get('/lookups/cities', [AdminLookupController::class, 'cities']);
        Route::post('/lookups/cities', [AdminLookupController::class, 'storeCity']);
        Route::put('/lookups/cities/{city}', [AdminLookupController::class, 'updateCity']);
        Route::delete('/lookups/cities/{city}', [AdminLookupController::class, 'deleteCity']);
        Route::get('/lookups/currencies', [AdminLookupController::class, 'currencies']);
        Route::post('/lookups/currencies', [AdminLookupController::class, 'storeCurrency']);
        Route::put('/lookups/currencies/{currency}', [AdminLookupController::class, 'updateCurrency']);
        Route::delete('/lookups/currencies/{currency}', [AdminLookupController::class, 'deleteCurrency']);
        Route::get('/lookups/feature_categories', [AdminLookupController::class, 'featureCategories']);
        Route::post('/lookups/feature_categories', [AdminLookupController::class, 'storeFeatureCategory']);
        Route::put('/lookups/feature_categories/{featureCat}', [AdminLookupController::class, 'updateFeatureCategory']);
        Route::delete('/lookups/feature_categories/{featureCat}', [AdminLookupController::class, 'deleteFeatureCategory']);
        Route::get('/lookups/features', [AdminLookupController::class, 'features']);
        Route::post('/lookups/features', [AdminLookupController::class, 'storeFeature']);
        Route::put('/lookups/features/{feature}', [AdminLookupController::class, 'updateFeature']);
        Route::delete('/lookups/features/{feature}', [AdminLookupController::class, 'deleteFeature']);
        Route::get('/settings', [AdminSettingsController::class, 'get']);
        Route::put('/settings', [AdminSettingsController::class, 'update']);
    });

    Route::get('/users/{user}', [ProfileController::class, 'publicProfile']);

    Route::middleware('auth:sanctum')->get('/notifications', [NotificationController::class, 'index']);

    Route::middleware('auth:sanctum')->put('/notifications/{notification}/read', [NotificationController::class, 'markAsRead']);

    Route::middleware('auth:sanctum')->delete('/notifications/{notification}/delete', [NotificationController::class, 'deleteNotification']);


    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
