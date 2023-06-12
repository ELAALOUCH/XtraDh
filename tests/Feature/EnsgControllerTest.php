<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Controllers\EtablissementController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\EnseignantController;
use Tests\TestCase;
use App\Models\User;

class TestEnseignantcontroller extends TestCase
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

        $response = $this->post('/api/Etablissement', [
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

        $response = $this->post('/api/Grade', [
            'designation'=> $designation,
            'charge_statutaire'=> $charge_statutaire,
            'Taux_horaire_Vocation'=> $Taux_horaire_Vocation,
        ]);

        $type = "Enseignant";
        $email = "testtest1@testing.com";
        $password = "test";
        $response = $this->post('/api/User', [
            'type' => $type,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);
        $PPR = "123456";
        $Nom = "Doe";
        $Prenom = "John";
        $DateNaissance = "1990-01-01";
        $Etablissement = 1; 
        $idGrade = 1; 
        $idUser = 1; 
        
        $response = $this->post('/api/Enseignant', [
            'PPR' => $PPR,
            'Nom' => $Nom,
            'prenom' => $Prenom,
            'Date_Naissance' => $DateNaissance,
            'Etablissement' => $Etablissement,
            'id_Grade' => $idGrade,
            'id_user' => $idUser,
        ]);

    }
     public function testEnseignantStore()
    {
        $code = "la1234";
        $Nom = "Groupe scolaire L'élitee";
        $Telephone = "0655967517";
        $Faxe = "418 643‑3210";
        $ville = "Casanegra";
        $Nbr_enseignants = 50;

        $response = $this->post('/api/Etablissement', [
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

        $response = $this->post('/api/Grade', [
            'designation'=> $designation,
            'charge_statutaire'=> $charge_statutaire,
            'Taux_horaire_Vocation'=> $Taux_horaire_Vocation,
        ]);

        $type = "AdminX";
        $email = "testtest2@testing.com";
        $password = "test";
        $response = $this->post('/api/User', [
            'type' => $type,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);
        $PPR = "1234567";
        $Nom = "testnom1";
        $Prenom = "testprenom1";
        $DateNaissance = "1990-01-01";
        $Etablissement = 2; 
        $idGrade = 2; 
        $idUser = 2; 
        
        $response = $this->post('/api/Enseignant', [
            'PPR' => $PPR,
            'Nom' => $Nom,
            'prenom' => $Prenom,
            'Date_Naissance' => $DateNaissance,
            'Etablissement' => $Etablissement,
            'id_Grade' => $idGrade,
            'id_user' => $idUser,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('enseignants', [
            'id' => 2,
            'PPR' => '1234567'
        ]);

        $response->assertJsonStructure([
            'PPR',
            'Nom',
            'prenom',
            'Date_Naissance',
            'Etablissement',
            'id_Grade',
            'id_user', 
            
        ]);

        $this->assertNotEmpty($response['id']);
    } 
    public function testShowEnseignant()
    {
        $id = 1;

        $response = $this->get('api/Enseignant/' . $id);

        $response->assertStatus(200);

        $jsonResponse = $response->json();
        print_r($jsonResponse);
        $response->assertStatus(200)
        ->assertJsonStructure([
            '*'=>[
            'PPR',
            'Nom',
            'prenom',
            'Date_Naissance',
            'Etablissement',
            'id_Grade',
            'id_user', 
            ]
    ]);
    }
    public function testIndexEnseignant()
    {
        $response = $this->get('api/Enseignant');

        $response->assertStatus(200);

        $jsonResponse = $response->json();
        print_r($jsonResponse);
        $response->assertStatus(200)
        ->assertJsonStructure([
         '*' => [
            'PPR',
            'Nom',
            'prenom',
            'Date_Naissance',
            'Etablissement',
            'id_Grade',
            'id_user', ]
    ]);
    }
    public function testDestroyEnseignant()
    {   
        $id=1;
        $response = $this->delete('/api/Enseignant/' . $id);
        
        $response->assertStatus(200);
        $this->assertDatabaseMissing('enseignants', ['id' => $id]);
    }
    public function testUpdateEnseignant()
{
    $id=1;
    $modification = [
        'PPR' => "123456789",
        'Nom' => "testnom2",
        'prenom' => "testprenom2",
        'Date_Naissance' => "1989-01-01",
        'Etablissement' => 1,
        'id_Grade' => 1, 
        'id_user' => 1, 
    ];
    $response = $this->put("/api/Enseignant/{$id}", $modification);

    $response->assertStatus(200);
// pour check si la table users de la bd contient une ligne avec les infos qu'on vient de modifier 
    $this->assertDatabaseHas('enseignants', [
        'id' => $id,
        'PPR' => '123456789'
    ]);
// pour check si l'objet retourné est pareil à ce qu'on veut 
    $response->assertJson([
        'PPR' => "123456789",
        'Nom' => "testnom2",
        'prenom' => "testprenom2",
        'Date_Naissance' => "1989-01-01",
        'Etablissement' => 1,
        'id_Grade' => 1, 
        'id_user' => 1, 
    ]);
} 
   
    public function tearDown(): void
    {
        $this->artisan('migrate:rollback');
        parent::tearDown();
    }
    
}