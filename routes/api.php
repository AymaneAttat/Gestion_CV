<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SkillsController;
use App\Http\Controllers\Api\ProfilesController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\MailProfileController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});


Route::group(['middleware' => 'api'], function($router){
    Route::get('/skills-index', [SkillsController::class, 'index'])->name('skills.index');
    Route::post('/upload-content',[SkillsController::class,'uploadContent'])->name('import.content');
    Route::post('/upload-skill',[SkillsController::class,'store'])->name('skill.store');
    Route::get('/livesearch', [SkillsController::class, 'getSkills'])->name('search.skill');
    Route::get('/CountSkills', [SkillsController::class, 'getCountSkills'])->name('nbrSkills');

    Route::get('/profiles-index', [ProfilesController::class, 'index'])->name('profiles.index');
    Route::post('/upload-profiles',[ProfilesController::class,'uploadContent'])->name('import.profiles');
    Route::get('/show-profile/{profile}', [ProfilesController::class,'show'])->name('show.profile');
    Route::put('/update-profile/{profile}', [ProfilesController::class,'update'])->name('update.profile');
    Route::delete('/delete-profile/{profile}', [ProfilesController::class,'destroy'])->name('delete.profile');
    Route::get('/searchProfiles', [ProfilesController::class, 'searchProfile'])->name('search.profile');///{id}
    Route::get('/CountProfiles', [ProfilesController::class, 'getCountProfiles'])->name('nbrProfiles');
    Route::get('/liveSearchProfiles', [ProfilesController::class, 'getSearchProfiles'])->name('search.profile1');
    Route::post('/store-cv',[ProfilesController::class,'uploadCV'])->name('import.CV');
    Route::post('/store-all-cv',[ProfilesController::class,'uploadAllCV'])->name('import.all.CV');
    Route::get('/downloadPdf/{id}',[ProfilesController::class,'downloadCV'])->name('download.CV');

    Route::post('/sendEmails',[MailProfileController::class,'sendMail'])->name('send.emails');

    Route::get('/users-index', [UsersController::class, 'index'])->name('users.index');
});
/*
Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/permissions', [RoleManager::class, 'permissionsIndex'])->name('permissions.index')->middleware('permission:View All Permissions');

    Route::get('/roles', [RoleManager::class, 'rolesIndex'])->name('roles.index')->middleware('permission:View All Roles');

    Route::post('/roles/{role}/assign/{user}', [RoleManager::class, 'rolesAddUser'])->name('roles.addUser')->middleware('permission:Assign Role');

    Route::post('/roles/{role}/unassign/{user}', [RoleManager::class, 'rolesRemoveUser'])->name('roles.removeUser')->middleware('permission:Unassign Role');

    Route::get('/users', [UsersController::class, 'index'])->name('users.index')->middleware('role:super-admin');
});*/