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

// Routes publiques
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot', [ForgetController::class, 'forgot']);
Route::post('/reset', [ForgetController::class, 'reset']);

// Routes authentifiées
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/adminprofile', [userController::class, 'adminProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

// Routes pour le rôle "admin_univ"
Route::middleware(['auth:sanctum','role:admin_univ'])->group( function () {
    // Routes protégées pour admin_univ

    Route::get('/directeuretab', [AdministrateurController::class, 'directeurETB']);
    Route::get('/listeAdminETBforadminuae', [AdministrateurController::class, 'listeAdminETBforadminuae']);
    Route::get('/listepresidentuaeforadminuae', [AdministrateurController::class, 'listepresidentuaeforadminuae']);
    Route::get('/listedirecteuretbforadminuae', [AdministrateurController::class, 'listedirecteuretbforadminuae']);

});





// Routes pour le rôle "directeur_etb"

Route::middleware(['auth:sanctum', 'role:directeur_etb'])->group(function () {

    Route::get('/valideretb/{id}', [InterventionController::class, 'valideretb']);
    Route::get('/invalideretb/{id}', [InterventionController::class, 'invalideretb']);
    Route::get('/consultpaiementetabdirecteur', [PaiementController::class, 'consultpaiementetabdirecteur']);
    Route::get('/directeuretabintervall', [InterventionController::class, 'directeuretabintervall']);
    Route::get('/directeuretabintervvalid', [InterventionController::class, 'directeuretabintervvalid']);
    Route::get('/profetab',[EnseignantController::class,'indexetb'])->middleware('auth:sanctum');

});

// Routes pour le rôle "presidnt_univ"
Route::middleware(['auth:sanctum', 'role:presidnt_univ'])->group(function () {


    Route::get('/valideruae/{id}', [InterventionController::class, 'valideruae']);
    Route::get('/invalideruae/{id}', [InterventionController::class, 'invalideruae']);


});

// Routes pour le rôle "prof"
Route::middleware(['auth:sanctum', 'role:prof'])->group(function () {



});




















Route::group(['middleware' =>'auth:sanctum' ,'role'=>['admin_univ','admin_etb']],function() {
    Route::apiResource('etablissement', EtablissementController::class);
    Route::apiResource('grade', GradeController::class);
    Route::delete('/deleteadm/{id_user}', [userController::class, 'destroyadmin']);
    Route::delete('/deleteprof/{id_user}', [userController::class, 'destroyprof']);
    Route::get('/profetab', [EnseignantController::class, 'indexetb']);
    Route::get('/interventionuaevalid', [InterventionController::class, 'interventionuaevalid']);
    Route::get('/directeuretab', [AdministrateurController::class, 'directeurETB'])->middleware('auth:sanctum');
    Route::post('/ajoutinterventionetab', [userController::class, 'ajoutinterventionetab']);
});


Route::group(['middleware' =>'auth:sanctum' ,'role'=>['admin_univ','admin_etb','directeur_etb','president_univ']],function() {
    Route::apiResource('administrateur', AdministrateurController::class);
    Route::post('/storePPR', [InterventionController::class, 'storePPR']);
    Route::patch('/updateadm/{idAdm}', [userController::class, 'updateAdm']);
    Route::apiResource('intervention', InterventionController::class);
});

Route::group(['middleware' =>'auth:sanctum' ,'role'=>['admin_univ','prof','president_univ']],function() {
    Route::apiResource('Paiement', PaiementController::class);
    Route::get('/paiementprof', [PaiementController::class, 'paiementprof']);

});


Route::group(['middleware' =>'auth:sanctum' ,'role'=>['admin_univ','admin_etb','directeur_etb']],function() {
    Route::post('/storeprofetb', [userController::class, 'storeProfEtb']);
    Route::post('/storeadminetb', [userController::class, 'storeAdmEtb']);
});


Route::group(['middleware' =>'auth:sanctum' ,'role'=>['admin_univ','prof','admin_etb']],function() {
    Route::apiResource('enseignant', EnseignantController::class);
    Route::patch('/updateprof/{idprof}', [userController::class, 'updateprof']);
    Route::get('/profprofile', [userController::class, 'profProfile']);

});


Route::group(['middleware' =>'auth:sanctum' ,'role'=>['prof','president_univ']],function() {
    Route::get('/historiquepdfpaie', [PaiementController::class, 'historiquepdfpaie']);
    Route::get('/getintervention', [InterventionController::class, 'getprofIntervention']);
});
