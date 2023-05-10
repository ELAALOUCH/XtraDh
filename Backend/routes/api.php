<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\userController;

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

/* Etablissement Routes */
Route::apiResource('Etablissement',EtablissementController::class); 

/*Grade Routes */ 
Route::apiResource('Grade',GradeController::class);

/* Enseignant routes */

Route::apiResource('Enseignant',EnseignantController::class);

/* Administrateur routes */

Route::apiResource('Administrateur',AdministrateurController::class);

/* Intervention Routes */
Route::apiResource('Intervention',InterventionController::class);

/* Paiement Routes */
Route::apiResource('Paiement',PaiementController::class);
 
/* Uusers Routes */
Route::apiResource('User',userController::class);


