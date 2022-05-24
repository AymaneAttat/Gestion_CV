<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
/*>middleware(['auth'
Route::get('/create_role_permission',function(){
    dd(Auth::user());
    $role_r = Role::where('name', '=', 'Administrator')->firstOrFail();
    Auth()->user()->assignRole($role_r);
    Auth()->user()->givePermissionTo(['ajouter_profiles', 'voir_profiles', 'ajouter_CV', 'ajouter_competences', 'ajouter_competence', 'telecharger_cv', 'ajouter_utilisateur']);
});*/
//Route::get('/create_role_permission', [AuthController::class, 'CreateRolePermission']);
Route::view('/{any}', 'index')->where('any', '.*');
