<?php

use App\Http\Controllers\Api\TempCardController;
use App\Http\Controllers\Api\TempVolController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::apiResource('tempCards',TempCardController::class);
// Route::controller(TempCardController::class)->group(function(){
//     Route::post('scankartu','ScanKartu')
//         ->name('nokartu.scankartu');
//         // Route::get('scankartu/{noRFID}','ScanKartu')
//         //     ->name('nokartu.scankartu');
// });
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tempCards',TempCardController::class);
    Route::controller(TempCardController::class)->group(function(){
        Route::post('scankartu','ScanKartu')
            ->name('nokartu.scankartu');
        // Route::get('scankartu/{noRFID}','ScanKartu')
        //     ->name('nokartu.scankartu');
    });

    Route::controller(TempVolController::class)->group(function(){
        Route::post('kirimvol','UkurVolTimbangan')
            ->name('ukur.timbangan');
        // Route::get('scankartu/{noRFID}','ScanKartu')
        //     ->name('nokartu.scankartu');
    });
});