<?php
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\ForgetController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\EtablissementController;
use Illuminate\Support\Facades\Route;


Route::apiResource('user',UserController::class);
// Routes publiques
Route::get('postfix', [PaiementController::class, 'postfix']);
Route::get('/generate-pdf/{prof}', [PaiementController::class, 'generatePDFprof']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot', [ForgetController::class, 'forgot']);
Route::post('/reset', [ForgetController::class, 'reset']);

// Routes authentifiées
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/adminprofile', [UserController::class, 'adminProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

// Routes pour le rôle "admin_univ"
Route::middleware(['auth:sanctum', 'role:admin_univ'])->group(function () {
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
    Route::get('/profetab', [EnseignantController::class, 'indexetb'])->middleware('auth:sanctum');
});


// Routes pour le rôle "president_univ"
Route::middleware(['auth:sanctum', 'role:president_univ'])->group(function () {
    Route::get('/valideruae/{id}', [InterventionController::class, 'valideruae']);
    Route::get('/invalideruae/{id}', [InterventionController::class, 'invalideruae']);
    Route::get('/interventionuaevalid', [InterventionController::class, 'interventionuaevalid']);
});

// Routes pour le rôle "prof"


// Routes pour les rôles "admin_univ" et "admin_etb"
Route::middleware(['auth:sanctum', 'role:admin_univ|admin_etb'])->group(function () {

    Route::apiResource('grade', GradeController::class);
    Route::delete('/deleteadm/{id_user}', [UserController::class, 'destroyadmin']);
    Route::delete('/deleteprof/{id_user}', [UserController::class, 'destroyprof']);
    Route::get('/profetab', [EnseignantController::class, 'indexetb']);
    Route::post('/storePPR', [InterventionController::class, 'storePPR']);
    Route::get('/directeuretab', [AdministrateurController::class, 'directeurETB'])->middleware('auth:sanctum');
    Route::post('/ajoutinterventionetab', [UserController::class, 'ajoutinterventionetab']);
});

// Routes pour les rôles "admin_univ", "admin_etb", "directeur_etb" et "president_univ"
Route::middleware(['auth:sanctum', 'role:admin_univ|admin_etb|directeur_etb|president_univ'])->group(function () {
    Route::apiResource('etablissement', EtablissementController::class);
    Route::apiResource('administrateur', AdministrateurController::class);
    Route::patch('/updateadm/{idAdm}', [UserController::class, 'updateAdm']);
    Route::apiResource('intervention', InterventionController::class);

});

// Routes pour les rôles "admin_univ", "prof" et "president_univ"
Route::middleware(['auth:sanctum', 'role:admin_univ|prof|president_univ'])->group(function () {
    Route::apiResource('paiement', PaiementController::class);
    Route::get('/paiementprof', [PaiementController::class, 'paiementprof']);
});

// Routes pour les rôles "admin_univ", "admin_etb" et "directeur_etb"
Route::middleware(['auth:sanctum', 'role:admin_univ|admin_etb|directeur_etb'])->group(function () {
    Route::post('/storeprofetb', [UserController::class, 'storeProfEtb']);
    Route::post('/storeadminetb', [UserController::class, 'storeAdmEtb']);
});

// Routes pour les rôles "admin_univ", "prof" et "admin_etb"
Route::middleware(['auth:sanctum', 'role:admin_univ|prof|admin_etb'])->group(function () {
    Route::apiResource('enseignant', EnseignantController::class);
    Route::patch('/updateprof/{idprof}', [UserController::class, 'updateprof']);
    Route::get('/profprofile', [UserController::class, 'profProfile']);
});

// Routes pour les rôles "prof" et "president_univ"
Route::middleware(['auth:sanctum', 'role:prof|president_univ'])->group(function () {
    Route::get('/historiquepdfpaie', [PaiementController::class, 'historiquepdfpaie']);
    Route::get('/getintervention', [InterventionController::class, 'getprofIntervention']);
});


