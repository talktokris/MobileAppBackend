<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\api\SettingDataController;
use App\Http\Controllers\api\JobsController;
use App\Http\Controllers\api\ResumeController;
use App\Http\Controllers\api\AuthController;


use App\Http\Controllers\api\EducationController;
use App\Http\Controllers\api\ExperienceController;
use App\Http\Controllers\api\FavoriteJobsController;

use App\Http\Controllers\api\JobPreferenceController;
use App\Http\Controllers\api\TraningController;
use App\Http\Controllers\api\SkillController;
use App\Http\Controllers\api\LanguageController;

use App\Http\Controllers\api\JobApplyController;
use App\Http\Controllers\api\PushMessageController;


/*
Route::group(['middleware' => 'api',], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/profile', [AuthController::class, 'profile']);
    Route::post('/register', [AuthController::class, 'register']);

});
*/
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('profile', 'profile');

});

Route::controller(EducationController::class)->group(function () {
    Route::post('education/create', 'store');
    Route::post('education/update/{id}', 'update');
    Route::delete('education/delete/{id}', 'destroy');
});

Route::controller(ExperienceController::class)->group(function () {
    Route::post('experience/create', 'store');
    Route::post('experience/update/{id}', 'update');
    Route::delete('experience/delete/{id}', 'destroy');
});

Route::controller(FavoriteJobsController::class)->group(function () {
    Route::post('favorite-jobs/create', 'store');
    Route::post('favorite-jobs/update/{id}', 'update');
    Route::delete('favorite-jobs/delete/{id}', 'destroy');
});

Route::controller(JobPreferenceController::class)->group(function () {
    Route::post('job-preference/create', 'store');
    Route::post('job-preference/update/{id}', 'update');
    Route::delete('job-preference/delete/{id}', 'destroy');
});

Route::controller(TraningController::class)->group(function () {
    Route::post('training/create', 'store');
    Route::post('training/update/{id}', 'update');
    Route::delete('training/delete/{id}', 'destroy');
});


Route::controller(SkillController::class)->group(function () {
    Route::post('skill/create', 'store');
    Route::post('skill/update/{id}', 'update');
    Route::delete('skill/delete/{id}', 'destroy');
});

Route::controller(LanguageController::class)->group(function () {
    Route::post('language/create', 'store');
    Route::post('language/update/{id}', 'update');
    Route::delete('language/delete/{id}', 'destroy');
});



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

//Route::post('/register', [AuthController::class, 'me']);



//*/


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
Route::get('/jobs/list', [JobsController::class, 'activeJobList']);
Route::get('/jobs/{id}', [JobsController::class, 'activeJobSingle']);
Route::get('/jobs/search/{word}', [JobsController::class, 'activeJobSearch']);

Route::get('/jobs/fav/{user_id}', [JobsController::class, 'activeJobFav']);


Route::post('/resume', [ResumeController::class, 'activeResumePost']);

Route::get('/resume/{id}', [ResumeController::class, 'activeResumeGet']);
Route::post('/basic/update/{id}', [ResumeController::class, 'basicUpdate']);
Route::post('/personal/update/{id}', [ResumeController::class, 'personalUpdate']);
Route::post('/image/upload/{id}', [ResumeController::class, 'imageUpload']);
Route::get('/jobs/applied/{id}', [JobApplyController::class, 'index']);
Route::post('/jobs/apply', [JobApplyController::class, 'store']);
Route::get('/push/message/{id}', [PushMessageController::class, 'index']);

Route::post('/push/device/{id}', [PushMessageController::class, 'pushIdUpdate']);




//Public Routes end

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

*/
