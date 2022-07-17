<?php
use App\Http\Controllers\api\SettingDataController;
use App\Http\Controllers\api\JobsController;
use App\Http\Controllers\api\ResumeController;
use App\Http\Controllers\api\AuthController;

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

//Route::post('/register', [AuthController::class, 'me']);


Route::group(['middleware' => 'api',], function ($router) {

    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/profile', [AuthController::class, 'profile']);
    Route::post('/register', [AuthController::class, 'register']);

});
//*/
/*
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});
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
Route::get('/jobs/list', [JobsController::class, 'activeJobList']);
Route::get('/jobs/{id}', [JobsController::class, 'activeJobSingle']);
Route::get('/jobs/search/{word}', [JobsController::class, 'activeJobSearch']);

Route::get('/jobs/fav/{user_id}', [JobsController::class, 'activeJobFav']);


Route::get('/users', [ResumeController::class, 'activeResume']);



//Public Routes end

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

*/