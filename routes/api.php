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



/* Paiement Routes */
Route::apiResource('Paiement',PaiementController::class);





/** AUTH ROUTE */
Route::post('/login',[AuthController::class,'login']);
Route::post('/Forgot',[ForgetController::class,'forgot']);
Route::post('/reset',[ForgetController::class,'reset']);


/** GENERATE PDF */
Route::get('postfix', [PaiementController::class, 'postfix']);
Route::get('/generate-pdf/{prof}', [PaiementController::class, 'generatePDFprof']);



/**  Users Routes */
Route::apiResource('User',userController::class);
Route::post('/storeProfEtb',[userController::class,'storeProfEtb'])->middleware("auth:sanctum");
Route::post('/storeAdmEtb',[userController::class,'storeAdmEtb'])->middleware("auth:sanctum");
Route::patch('/updateprof/{idprof}',[userController::class,'updateprof'])->middleware("auth:sanctum");


//protected routes
Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/user-profile',[AuthController::class,'userProfile']);

});


/*
Route::middleware('auth:sanctum')->get('/api/profile', function (Request $request) {
    $user = $request->user();
    // Use $user to retrieve user information or perform actions
    return response()->json($user);
});
*/

Route::middleware(['auth:sanctum','role:admin_univ'])->group( function () {
    //protected for admin univ
    Route::apiResource('Etablissement',EtablissementController::class);
    /*Grade Routes */
Route::apiResource('Grade',GradeController::class);
/* Enseignant routes */

Route::apiResource('Enseignant',EnseignantController::class);
/* Administrateur routes */

Route::apiResource('Administrateur',AdministrateurController::class);
/* Intervention Routes */
Route::apiResource('Intervention',InterventionController::class);

});

Route::middleware(['auth:sanctum','role:admin_etb'])->group( function () {
    //protected for admin etb
    /* Enseignant routes */

Route::apiResource('Enseignant',EnseignantController::class);
/* Intervention Routes */
Route::apiResource('Intervention',InterventionController::class);
// /* Paiement Routes */
// Route::apiResource('Paiement',PaiementController::class);
});

Route::middleware(['auth:sanctum','role:directeur'])->group( function () {
    //protected for directeur
    Route::get('/valideretb/{id}',[InterventionController::class,'valideretb']);
Route::get('/invalideretb/{id}',[InterventionController::class,'invalideretb']);
});

Route::middleware(['auth:sanctum','role:présidnt'])->group( function () {
    //protected for président
    Route::get('/valideruae',[InterventionController::class,'valideruae']);
Route::get('/invalideruae',[InterventionController::class,'invalideruae']);
});

Route::middleware(['auth:sanctum','role:prof'])->group( function () {
    //protected for prof
    Route::apiResource('Enseignant',EnseignantController::class);
});












