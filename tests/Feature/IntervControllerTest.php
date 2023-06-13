<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\InterventionController;
use Tests\TestCase;
use App\Models\User;
use App\Models\grade;
use App\Models\etablissement;
use App\Models\Enseignant;
use App\Models\Intervention;
use App\Models\Administrateur;
use App\Models\Paiement;

class TestInterventioncontroller extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $code = "la123";
        $Nom = "Groupe scolaire L'élite";
        $Telephone = "0655967517";
        $Faxe = "418 643‑3210";
        $ville = "Casanegra";
        $Nbr_enseignants = 50;

        $response = $this->post('/api/etablissement', [
            'code'=> $code,
            'Nom'=> $Nom,
            'Telephone'=> $Telephone,
            'Faxe'=> $Faxe,
            'ville'=> $ville,
            'Nbr_enseignants'=> $Nbr_enseignants,
        ]);
        $code = "la123456789";
        $Nom = "Groupe scolaire L'élitex";
        $Telephone = "0655967517";
        $Faxe = "418 643‑3210";
        $ville = "Casablanca";
        $Nbr_enseignants = 50;

        $response = $this->post('/api/etablissement', [
            'code'=> $code,
            'Nom'=> $Nom,
            'Telephone'=> $Telephone,
            'Faxe'=> $Faxe,
            'ville'=> $ville,
            'Nbr_enseignants'=> $Nbr_enseignants,
        ]);

        $designation = "Grade T";
        $charge_statutaire = "50";
        $Taux_horaire_Vocation = "100";

        $response = $this->post('/api/grade', [
            'designation'=> $designation,
            'charge_statutaire'=> $charge_statutaire,
            'Taux_horaire_Vocation'=> $Taux_horaire_Vocation,
        ]);

        $type = "Enseignant";
        $email = "testtest1@testing.com";
        $password = "test";
        $response = $this->post('/api/user', [
            'type' => $type,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);
        $PPR = "123456";
        $Nom = "testnom";
        $Prenom = "testprenom";
        $DateNaissance = "1990-01-01";
        $Etablissement = 1; 
        $idGrade = 1; 
        $idUser = 1; 
        
        $response = $this->post('/api/enseignant', [
            'PPR' => $PPR,
            'Nom' => $Nom,
            'prenom' => $Prenom,
            'Date_Naissance' => $DateNaissance,
            'Etablissement' => $Etablissement,
            'id_Grade' => $idGrade,
            'id_user' => $idUser,
        ]);
        $id_Intervenant =1;
        $id_Etab = 2;
        $Intitule_Intervention = 'Test Intervention';
        $Annee_univ = '2022-2023';
        $Semestre = 'automne';
        $Date_debut = '2023-01-01';
        $Date_fin = '2023-02-28';
        $Nbr_heures = 40;
        $response = $this->post('/api/intervention', [
            'id_Intervenant' => $id_Intervenant,
            'id_Etab' => $id_Etab,
            'Intitule_Intervention' => $Intitule_Intervention,
            'Annee_univ' => $Annee_univ,
            'Semestre' => $Semestre,
            'Date_debut' => $Date_debut,
            'Date_fin' => $Date_fin,
            'Nbr_heures' => $Nbr_heures
        ]);
    }
     public function testInterventionStore()
    {
        $code = "la123456";
        $Nom = "Groupe scolaire L'éliteux";
        $Telephone = "0655967517";
        $Faxe = "418 643‑3210";
        $ville = "Casanegra";
        $Nbr_enseignants = 50;

        $response = $this->post('/api/etablissement', [
            'code'=> $code,
            'Nom'=> $Nom,
            'Telephone'=> $Telephone,
            'Faxe'=> $Faxe,
            'ville'=> $ville,
            'Nbr_enseignants'=> $Nbr_enseignants,
        ]);

        $designation = "Grade X";
        $charge_statutaire = "50";
        $Taux_horaire_Vocation = "100";

        $response = $this->post('/api/grade', [
            'designation'=> $designation,
            'charge_statutaire'=> $charge_statutaire,
            'Taux_horaire_Vocation'=> $Taux_horaire_Vocation,
        ]);

        $type = "EnseignantX";
        $email = "testtest2@testing.com";
        $password = "test";
        $response = $this->post('/api/user', [
            'type' => $type,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);
        $PPR = "123456789";
        $Nom = "testnom";
        $Prenom = "testprenom";
        $DateNaissance = "1989-01-01";
        $Etablissement = 2; 
        $idGrade = 2; 
        $idUser = 2; 
        
        $response = $this->post('/api/enseignant', [
            'PPR' => $PPR,
            'Nom' => $Nom,
            'prenom' => $Prenom,
            'Date_Naissance' => $DateNaissance,
            'Etablissement' => $Etablissement,
            'id_Grade' => $idGrade,
            'id_user' => $idUser,
        ]);
        $id_Intervenant =2;
        $id_Etab = 1;
        $Intitule_Intervention = 'Test Intervention';
        $Annee_univ = '2022-2023';
        $Semestre = 'automne';
        $Date_debut = '2023-01-01';
        $Date_fin = '2023-02-28';
        $Nbr_heures = 40;
        $response = $this->post('/api/intervention', [
            'id_Intervenant' => $id_Intervenant,
            'id_Etab' => $id_Etab,
            'Intitule_Intervention' => $Intitule_Intervention,
            'Annee_univ' => $Annee_univ,
            'Semestre' => $Semestre,
            'Date_debut' => $Date_debut,
            'Date_fin' => $Date_fin,
            'Nbr_heures' => $Nbr_heures
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('interventions', [
            'id_intervention' => 2,
            'id_Intervenant' => 2,
        ]);

        $this->assertNotNull($response);
    } 
    public function testShowIntervention()
    {
        $id = 1;

        $response = $this->get('api/intervention/' . $id);

        $response->assertStatus(200);

        $jsonResponse = $response->json();
        $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
            'id_Intervenant',
            'id_Etab',
            'Intitule_Intervention', 
            'Annee_univ', 
            'Semestre',
            'Date_debut', 
            'Date_fin', 
            'Nbr_heures',]
            
        ]); 
    }
    public function testIndexIntervention()
    {
        $response = $this->get('api/intervention');

        $response->assertStatus(200);

        $jsonResponse = $response->json();
        print_r($jsonResponse);
        
        $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
            'id_Intervenant',
            'id_Etab',
            'Intitule_Intervention', 
            'Annee_univ', 
            'Semestre',
            'Date_debut', 
            'Date_fin', 
            'Nbr_heures',]
            
        ]); 
    }
    public function testDestroyIntervention()
    {   
        $id=1;
        $response = $this->delete('/api/intervention/' . $id);
        
        $response->assertStatus(200);
        $this->assertDatabaseMissing('interventions', ['id_intervention' => $id]);
    }
    public function testUpdateIntervention()
{
    $id=1;
    $modification = [
            'id_Intervenant'=>'1',
            'id_Etab'=>'2',
            'Intitule_Intervention'=>'Nouvelle inter',
            'Annee_univ'=>'2022-2023',
            'Semestre'=>'automne',
            'Date_debut'=>'2023-01-01',
            'Date_fin'=>'2023-02-28',
            'Nbr_heures'=>'42'
    ];
    $response = $this->put("/api/intervention/{$id}", $modification);

    $response->assertStatus(200);
// pour check si la table users de la bd contient une ligne avec les infos qu'on vient de modifier 
    $this->assertDatabaseHas('interventions', [
        'id_intervention' => $id,
        'Intitule_Intervention'=>'Nouvelle inter'
    ]);
// pour check si l'objet retourné est pareil à ce qu'on veut 
    $response->assertJson([
            'id_Intervenant'=>'1',
            'id_Etab'=>'2',
            'Intitule_Intervention'=>'Nouvelle inter',
            'Annee_univ'=>'2022-2023',
            'Semestre'=>'automne',
            'Date_debut'=>'2023-01-01',
            'Date_fin'=>'2023-02-28',
            'Nbr_heures'=>'42'
    ]);
}

public function testValiderUae()
    {
        $interv = Intervention::factory()->create();
        $id=$interv['id_intervention'];
        $response=$this->get('/api/valideruae/'.$id);
        $response->assertStatus(200);
        $response->assertJson([
            'id_intervention'=>$id,
            'visa_uae' => 1,
        ]);
    }

    public function testInvaliderUae()
    {
        $interv = Intervention::factory()->create();
        $id=$interv['id_intervention'];
        $response=$this->get('/api/valideruae/'.$id);
        $response->assertStatus(200);
        $response->assertJson([
            'id_intervention'=>$id,
            'visa_uae' => 1,
        ]);
            
        $response=$this->get('/api/invalideruae/'.$id);
        $response->assertStatus(200);
        $this->assertDatabaseHas('interventions',[
            'id_intervention'=>$id,
            'visa_uae' => 0,
        ]);
    }

    public function testValiderEtb()
    {
        $interv = Intervention::factory()->create();
        $id=$interv['id_intervention'];
        $response=$this->get('/api/valideretb/'.$id);
        $response->assertStatus(200);
        $this->assertDatabaseHas('interventions',[
            'id_intervention'=>$id,
            'visa_etb' => 1,
        ]);
    }

    public function testInvaliderEtb()
    {
        $interv = Intervention::factory()->create();
        $id=$interv['id_intervention'];
        $response=$this->get('/api/valideretb/'.$id);
        $response->assertStatus(200);
        $this->assertDatabaseHas('interventions',[
            'id_intervention'=>$id,
            'visa_etb' => 1,
        ]);
        $response=$this->get('/api/invalideretb/'.$id);
        $response->assertStatus(200);
        $this->assertDatabaseHas('interventions',[
            'id_intervention'=>$id,
            'visa_etb' => 0,
        ]);
    }
    public function testDirecteurEtabIntervall()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $admin = Administrateur::factory()->create([
            'id_user' => $user->id_user,
        ]);

        $etb = $admin->Etablissement;

        $intervention = Intervention::factory()->create([
            'id_Etab' => $etb,
        ]);
       

        $response = $this->get('api/directeuretabintervall');

        $response->assertStatus(200);

    }
    public function testDirecteurEtabIntervValid()
    {
        // Crée un utilisateur factice authentifié
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crée un administrateur factice lié à l'utilisateur
        $admin = Administrateur::factory()->create([
            'id_user' => $user->id_user,
        ]);

        // Prépare les données de test
        $etb = $admin->Etablissement;

        $intervention1 = Intervention::factory()->create([
            'id_Etab' => $etb,
            'visa_etb' => 1,
        ]);

        $response = $this->get('api/directeuretabintervvalid');

        $response->assertStatus(200);

    }

    public function testProfIntervention()
    {
        // Crée un utilisateur factice authentifié en tant qu'enseignant
        $user = User::factory()->create([
            'type' => 'prof',
        ]);
        $this->actingAs($user);

        // Crée un enseignant factice lié à l'utilisateur
        $enseignant = Enseignant::factory()->create([
            'id_user' => $user->id_user,
        ]);

        // Crée des interventions factices dans la base de données
        $intervention1 = Intervention::factory()->create([
            // Définissez les attributs de l'intervention selon vos besoins
            'id_Intervenant' => $enseignant->id,
            'visa_etb' => 1,
            'visa_uae' => 1,
        ]);
        $intervention2 = Intervention::factory()->create([
            // Définissez les attributs de l'intervention selon vos besoins
            'id_Intervenant' => $enseignant->id,
            'visa_etb' => 0,
            'visa_uae' => 1,
        ]);

        // Appelle la méthode à tester
        $response = $this->get('api/getintervention');

        // Vérifie que la réponse contient les interventions valides attendues pour l'enseignant
        $response->assertStatus(200);

        $response->assertJsonMissing([$intervention2->toArray()]);
    }

    public function tearDown(): void
    {
        $this->artisan('migrate:rollback');
        parent::tearDown();
    }
    
}