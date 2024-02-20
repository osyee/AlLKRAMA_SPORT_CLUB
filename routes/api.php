<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrimesController ;
use App\Http\Controllers\ReplacmentsController ;
use App\Http\Controllers\WearsController ;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\EmployeesController ;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PlayersController;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\MatchesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['AuthUser'])->group(function () {

Route::post('logout',[App\Http\Controllers\Api\AuthController::class,'LogoutUser']);

Route::post('topfan/store',[App\Http\Controllers\TopfansController::class,'store']) ;
Route::post('topfan/update',[App\Http\Controllers\TopfansController::class,'update']) ;
Route::get('topfan/delete/{id}',[App\Http\Controllers\TopfansController::class,'delete']) ;

Route::post('club/store',[App\Http\Controllers\ClubsController::class,'store']) ;
Route::post('club/update',[App\Http\Controllers\ClubsController::class,'update']) ;
Route::get('club/delete/{id}',[App\Http\Controllers\ClubsController::class,'delete']) ;


Route::post('association/store',[App\Http\Controllers\AssociationsController::class,'store']) ;
Route::post('association/update',[App\Http\Controllers\AssociationsController::class,'update']) ;
Route::get('association/delete/{id}',[App\Http\Controllers\AssociationsController::class,'delete']) ;


Route::post('update/wear/{id}',[WearsController::class,'update'])->name('update-wear');
Route::post('store/wear',[WearsController::class,'store'])->name('store-wear');
Route::get('destore/wear/{id}',[WearsController::class,'destore'])->name('destore-wear');

Route::post('Primes-store',[PrimesController::class,'store']) ;
Route::post('Primes-update',[PrimesController::class,'update']) ;
Route::get('Primes-delete',[PrimesController::class,'delete']) ;

Route::post('Replacments-store',[ReplacmentsController::class,'store']) ;
Route::get('Replacments-update/{id}/edit',[ReplacmentsController::class,'edit']) ;
Route::put('Replacments-update/{id}/edit',[ReplacmentsController::class,'update']) ;
Route::delete('Replacments-Destroy/{id}/Destroy',[ReplacmentsController::class,'Destroy']) ;

Route::post('store/Information',[InformationController::class,'store'])->name('store-Information');
Route::get('destore/Information/{id}',[InformationController::class,'destore'])->name('destore-Information');
Route::get('update/Information/{id}',[InformationController::class,'update'])->name('update-Information');

Route::get('update/Statistics/{id}',[StatisticsController::class,'update'])->name('update-Statistics');
Route::get('destore/Statistics/{id}',[StatisticsController::class,'destore'])->name('destore-Statistics');

Route::get('store/Statistics',[StatisticsController::class,'store'])->name('store-Statistics');

Route::get('sport-delete/{id}',[SportsController::class,'destroy']) ;

Route::post('sport-store',[SportsController::class,'store']) ;
Route::post('sport-update/{id}',[SportsController::class,'update']) ;

Route::get('player-update/{id}',[PlayersController::class,'update']) ;
Route::post('player-store',[PlayersController::class,'store']) ;
Route::get('player-delete/{id}',[PlayersController::class,'destroy']) ;

Route::post('session-store',[SessionsController::class,'store']) ;
Route::post('session-update',[SessionsController::class,'update']) ;
Route::get('session-delete',[SessionsController::class,'delete']) ;

Route::post('plan-store',[PlansController::class,'store']) ;
Route::get('plan-delete',[PlansController::class,'delete']) ;

Route::post('employee-store',[EmployeesController::class,'store']) ;
Route::post('employee-update',[EmployeesController::class,'update']) ;
Route::post('employee-delete',[EmployeesController::class,'delete']) ;

Route::post('update/vidio/{id}',[VideosController::class,'update'])->name('update-vidio');
Route::post('store/vidio',[VideosController::class,'store'])->name('store-vidio');
Route::get('destore/vidio/{id}',[VideosController::class,'destore'])->name('destore-vidio');

 });

Route::post('register',[App\Http\Controllers\Api\AuthController::class,'RegisterUser']);
Route::post('login',[App\Http\Controllers\Api\AuthController::class,'LoginUser']);





Route::get('topfan-all',[App\Http\Controllers\TopfansController::class,'all']) ;
Route::get('topfan-show',[App\Http\Controllers\TopfansController::class,'show']) ;

Route::get('club-index',[App\Http\Controllers\ClubsController::class,'index']) ;

Route::get('association-index',[App\Http\Controllers\AssociationsController::class,'index']) ;

Route::get('index/wear',[WearsController::class,'index'])->name('index-wear');


/**========================Primes-Api======================== */
Route::get('Primes-index',[PrimesController::class,'index']) ;
Route::get('Primes-show',[PrimesController::class,'show']) ;

/**========================End Primes-Api======================== */

/**========================Replacments-Api======================== */
Route::get('Replacments-index',[ReplacmentsController::class,'index']) ;
Route::get('Replacments-show/{id}',[ReplacmentsController::class,'show']) ;

/**========================End Replacments-Api======================== */


////////////Information

Route::get('index/Information',[InformationController::class,'index'])->name('index-Information');


////////////Statistics

Route::get('index/Statistics',[StatisticsController::class,'index'])->name('index-Statistics');


///////////vidio

Route::get('index/vidio',[VideosController::class,'index'])->name('index-vidio');




Route::get('employee-index',[EmployeesController::class,'index']) ;
Route::get('employee-search', [EmployeesController::class,'search']);

Route::get('plan-index',[PlansController::class,'index']) ;


Route::get('session-index',[SessionsController::class,'index']) ;




// ...................player api

Route::get('player-show',[PlayersController::class,'show']) ;
Route::get('player-index/{id}',[PlayersController::class,'index']) ;


// ...................sports api

Route::get('sport-index/{id}',[SportsController::class,'index']) ;
Route::get('sport-show',[SportsController::class,'show']) ; 


