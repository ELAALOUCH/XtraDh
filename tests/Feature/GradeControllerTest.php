<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Controllers\GradeController;
use Tests\TestCase;
use App\Models\User;

class TestGradecontroller extends TestCase
{

     use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');

        $designation = "Grade T";
        $charge_statutaire = "50";
        $Taux_horaire_Vocation = "100";

        $response = $this->post('/api/grade', [
            'designation'=> $designation,
            'charge_statutaire'=> $charge_statutaire,
            'Taux_horaire_Vocation'=> $Taux_horaire_Vocation,
        ]);

        $designation = "Grade S";
        $charge_statutaire = "40";
        $Taux_horaire_Vocation = "120";

        $response = $this->post('/api/grade', [
            'designation'=> $designation,
            'charge_statutaire'=> $charge_statutaire,
            'Taux_horaire_Vocation'=> $Taux_horaire_Vocation,
        ]);
    }
     public function testGradeStore()
    {
        $designation = "Grade A";
        $charge_statutaire = "55";
        $Taux_horaire_Vocation = "160";

        $response = $this->post('/api/grade', [
            'designation'=> $designation,
            'charge_statutaire'=> $charge_statutaire,
            'Taux_horaire_Vocation'=> $Taux_horaire_Vocation,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('grades', [
            'designation'=> $designation,
        ]);

        $response->assertJsonStructure([
                'designation',
                'charge_statutaire',
                'Taux_horaire_Vocation',            
        ]);

        $this->assertNotEmpty($response['designation']);
    } 
    public function testShowGrade()
    {
        $id = 1;

        $response = $this->get('api/grade/' . $id);

        $response->assertStatus(200);

        $jsonResponse = $response->json();
        $response->assertStatus(200)
        ->assertJsonStructure([
            'designation',
            'charge_statutaire',
            'Taux_horaire_Vocation',            
    ]);
    }
    public function testIndexGrade()
    {
        $response = $this->get('api/grade');

        $response->assertStatus(200);

        $jsonResponse = $response->json();
        print_r($jsonResponse);
        
        $response->assertStatus(200)
        ->assertJsonStructure([
         '*' => [
                'designation',
                'charge_statutaire',
                'Taux_horaire_Vocation', ]
    ]);
    }
    public function testDestroyGrade()
    {   
        $id=2;
        $response = $this->delete('/api/grade/' . $id);
        
        $response->assertStatus(200);
        $this->assertDatabaseMissing('grades', ['id_Grade' => $id]);
    }
    public function testUpdateGrade()
{
    $id=2;
    $modification = [
        'designation' => "Grade B",
        'charge_statutaire' => 66,
        'Taux_horaire_Vocation' => 99,

    ];
    $response = $this->put("/api/grade/{$id}", $modification);

    $response->assertStatus(200);
// pour check si la table users de la bd contient une ligne avec les infos qu'on vient de modifier 
    $this->assertDatabaseHas('grades', [
        'id_Grade' => $id,
        'designation' => 'Grade B'
    ]);
// pour check si l'objet retourné est pareil à ce qu'on veut 
    $response->assertJson([
        'designation' => "Grade B",
        'charge_statutaire' => 66,
        'Taux_horaire_Vocation' => 99,
    ]);
}
    public function tearDown(): void
    {
        $this->artisan('migrate:rollback');
        parent::tearDown();
    }
    
}