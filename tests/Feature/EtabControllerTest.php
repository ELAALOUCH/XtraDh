<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Controllers\EtablissementController;
use Tests\TestCase;
use App\Models\User;

class TestEtablissementcontroller extends TestCase
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
        $code = "la1523";
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
    }
     public function testEtablissementStore()
    {
        $code = "la111";
        $Nom = "College Maghrib El jadid";
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

        $response->assertStatus(200);

        $this->assertDatabaseHas('etablissements', [
            'code'=> $code,
        ]);

        $this->assertNotEmpty($response);
    } 
    public function testShowEtablissement()
    {
        $id = 1;

        $response = $this->get('api/etablissement/' . $id);

        $response->assertStatus(200);

        $jsonResponse = $response->json();
        $response->assertStatus(200)
        ->assertJsonStructure([
            'code',
            'Nom',
            'Telephone',
            'Faxe',
            'ville',
            'Nbr_enseignants',
    ]);
    }
    public function testIndexEtablissement()
    {
        $response = $this->get('api/etablissement');

        $response->assertStatus(200);

        $jsonResponse = $response->json();
        print_r($jsonResponse);
        
        $response->assertStatus(200)
        ->assertJsonStructure([
         '*' => [
            'code',
            'Nom',
            'Telephone',
            'Faxe',
            'ville',
            'Nbr_enseignants', ]
    ]);
    }
    public function testDestroyEtablissement()
    {   
        $id=2;
        $response = $this->delete('/api/etablissement/' . $id);
        
        $response->assertStatus(200);
        $this->assertDatabaseMissing('etablissements', ['id' => $id]);
    }
    public function testUpdateEtablissement()
{
    $id=2;
    $modification = [
        'code' => "la12356",
        'Nom' => "Groupe scolaire L'éliteux",
        'Telephone' => "0655967517",
        'Faxe' => "418 643‑3210",
        'ville' => "Casablanca",
        'Nbr_enseignants' => 49,
    ];
    $response = $this->put("/api/etablissement/{$id}", $modification);

    $response->assertStatus(200);
// pour check si la table users de la bd contient une ligne avec les infos qu'on vient de modifier 
    $this->assertDatabaseHas('etablissements', [
        'id' => $id,
        'code' => 'la12356'
    ]);
// pour check si l'objet retourné est pareil à ce qu'on veut 
    $response->assertJson([
            'id' => $id,
            'code' => "la12356",
            'Nom' => "Groupe scolaire L'éliteux",
            'Telephone' => "0655967517",
            'Faxe' => "418 643‑3210",
            'ville' => "Casablanca",
            'Nbr_enseignants' => 49,
    ]);
}
    public function tearDown(): void
    {
        $this->artisan('migrate:rollback');
        parent::tearDown();
    }
    
}