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
use App\Models\Enseignant;
use Spatie\Csp\Nonce\NonceGenerator;
use Doctrine\Instantiator\InstantiatorInterface;
/*
Route::get('/api/get-nonce', function () {
    $nonce = app(NonceGenerator::class)->generate();

    return response()->json([
        'nonce' => $nonce,
    ]);
});*/
/* Etablissement Routes */



/* Paiement Routes */
Route::apiResource('paiement',PaiementController::class);
Route::get('/paiementprof',[PaiementController::class,'paiementprof'])->middleware("auth:sanctum");
Route::get('/historiquepdfpaie',[PaiementController::class,'historiquepdfpaie'])->middleware("auth:sanctum");
Route::get('/consultpaiementetabdirecteur',[PaiementController::class,'consultpaiementetabdirecteur'])->middleware("auth:sanctum");




/** AUTH ROUTE */
Route::post('/login',[AuthController::class,'login']);
Route::post('/forgot',[ForgetController::class,'forgot']);
Route::post('/reset',[ForgetController::class,'reset']);


/** GENERATE PDF */
Route::get('postfix', [PaiementController::class, 'postfix']);
Route::get('/generate-pdf/{prof}', [PaiementController::class, 'generatePDFprof']);



/**  Users Routes */
Route::apiResource('user',userController::class);
Route::post('/storeprofetb',[userController::class,'storeProfEtb'])->middleware("auth:sanctum");
Route::post('/storeadminetb',[userController::class,'storeAdmEtb'])->middleware("auth:sanctum");
Route::patch('/updateprof/{idprof}',[userController::class,'updateprof'])->middleware("auth:sanctum");
Route::patch('/updateadm/{idAdm}',[userController::class,'updateAdm'])->middleware("auth:sanctum");
Route::post('/ajoutinterventionetab',[userController::class,'ajoutinterventionetab'])->middleware("auth:sanctum");
Route::get('/adminprofile',[userController::class,'adminProfile'])->middleware("auth:sanctum");
Route::get('/profprofile',[userController::class,'profProfile'])->middleware("auth:sanctum");
Route::delete('/deleteadm/{id_user}',[userController::class,'destroyadmin']);



//protected routes
Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::post('/logout',[AuthController::class,'logout']);
    Route::get('/user-profile',[AuthController::class,'userProfile']);

});


/*
//Route::middleware('auth:sanctum')->get('/api/profile', function (Request $request) {
    $user = $request->user();
    // Use $user to retrieve user information or perform actions
    return response()->json($user);
//});
*/

//Route::middleware(['auth:sanctum','role:admin_univ'])->group( function () {
    //protected for admin univ
    Route::apiResource('etablissement',EtablissementController::class);




    /*Grade Routes */
Route::apiResource('grade',GradeController::class);








Route::apiResource('enseignant',EnseignantController::class);
/* Administrateur routes */



Route::apiResource('administrateur',AdministrateurController::class);
Route::get('/directeuretab',[AdministrateurController::class,'directeurETB'])->middleware('auth:sanctum');


/* Intervention Routes */
Route::apiResource('intervention',InterventionController::class);
Route::get('/getintervention',[InterventionController::class,'getprofIntervention'])->middleware('auth:sanctum');
Route::get('/directeuretabintervall',[InterventionController::class,'directeuretabintervall'])->middleware('auth:sanctum');
Route::get('/directeuretabintervvalid',[InterventionController::class,'directeuretabintervvalid'])->middleware('auth:sanctum');
//});

//Route::middleware(['auth:sanctum','role:admin_etb'])->group( function () {
    //protected for admin etb
    /* Enseignant routes */

Route::apiResource('enseignant',EnseignantController::class);
/* Intervention Routes */
Route::apiResource('intervention',InterventionController::class);
Route::get('/interventionuaevalid',[InterventionController::class,'interventionuaevalid']);




// /* Paiement Routes */
// Route::apiResource('Paiement',PaiementController::class);
//});





//          validation
//Route::middleware(['auth:sanctum','role:directeur_etb'])->group( function () {
    //protected for directeur
    Route::get('/valideretb/{id}',[InterventionController::class,'valideretb']);
Route::get('/invalideretb/{id}',[InterventionController::class,'invalideretb']);
//});

//Route::middleware(['auth:sanctum','role:presidnt_univ'])->group( function () {
    //protected for président
    Route::get('/valideruae/{id}',[InterventionController::class,'valideruae']);
Route::get('/invalideruae/{id}',[InterventionController::class,'invalideruae']);
//});

//Route::middleware(['auth:sanctum','role:prof'])->group( function () {
    //protected for prof
    Route::apiResource('enseignant',EnseignantController::class);
    Route::get('/profetab',[EnseignantController::class,'indexetb'])->middleware('auth:sanctum');
    Route::delete('/deleteprof/{id_user}',[userController::class,'destroyprof']);
//});












