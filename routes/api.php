<?php
use App\Http\Controllers\api\SettingDataController;
use App\Http\Controllers\api\JobsController;
use App\Http\Controllers\api\ResumeController;


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

//Public Routes start

// Setting list routes
Route::get('/country', [SettingDataController::class, 'countryIndex']);
Route::get('/education', [SettingDataController::class, 'educationIndex']);
Route::get('/experience', [SettingDataController::class, 'experienceIndex']);
Route::get('/skill', [SettingDataController::class, 'skillIndex']);
Route::get('/skill/level', [SettingDataController::class, 'skillLevelIndex']);
Route::get('/language', [SettingDataController::class, 'languageIndex']);
Route::get('/language/level', [SettingDataController::class, 'languageLevelIndex']);

// Job list routes
Route::get('/jobslist', [JobsController::class, 'activeJobList']);

Route::get('/users', [ResumeController::class, 'activeResume']);



//Public Routes end
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});