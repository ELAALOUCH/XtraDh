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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgetController;


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


/** AUTH ROUTE */
Route::post('/login',[AuthController::class,'login']);
Route::post('/Forgot',[ForgetController::class,'forgot']);
Route::post('/reset',[ForgetController::class,'reset']);



/*


//protected routes
Route::group(['middleware'=>['auth:sanctum']], function () {

});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/api/profile', function (Request $request) {
    $user = $request->user();
    // Use $user to retrieve user information or perform actions
    return response()->json($user);
});

Route::middleware(['auth:sanctum','role:admin_univ'])->group( function () {
    //protected for admin univ
});

Route::middleware(['auth:sanctum','role:admin_etb'])->group( function () {
    //protected for admin etb
});

Route::middleware(['auth:sanctum','role:directeur'])->group( function () {
    //protected for directeur
});

Route::middleware(['auth:sanctum','role:présidnt'])->group( function () {
    //protected for président
});

Route::middleware(['auth:sanctum','role:prof'])->group( function () {
    //protected for prof
});
*/











