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
use Doctrine\Instantiator\InstantiatorInterface;

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
Route::get('/valideruae',[InterventionController::class,'valideruae']);
Route::get('/invalideruae',[InterventionController::class,'invalideruae']);
Route::get('/valideretb/{id}',[InterventionController::class,'valideretb']);
Route::get('/invalideretb/{id}',[InterventionController::class,'invalideretb']);

/* Paiement Routes */
Route::apiResource('Paiement',PaiementController::class);

/* Uusers Routes */
Route::apiResource('User',userController::class);


/** AUTH ROUTE */
Route::post('/login',[AuthController::class,'login']);
Route::get('/user-profile',[AuthController::class,'userProfile']);

Route::post('/logout',[AuthController::class,'logout']);



Route::post('/Forgot',[ForgetController::class,'forgot']);
Route::post('/reset',[ForgetController::class,'reset']);

/** GENERATE PDF */
Route::get('postfix', [PaiementController::class, 'postfix']);
Route::get('/generate-pdf/{prof}', [PaiementController::class, 'generatePDFprof']);



//
/*

//protected routes
Route::group(['middleware'=>['auth:sanctum']], function () {

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






