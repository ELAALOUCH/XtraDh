<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\grade;
use App\Models\etablissement;
use App\Models\Enseignant;
use App\Models\Intervention;
use App\Models\Administrateur;
use App\Models\Paiement;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Controllers\UserController;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestPaiementcontroller extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }
     public function testPaiementStore()
    {

        $paiement=Paiement::factory()->create();
        $paiement = $paiement->toArray();
        print_r($paiement);
        $response = $this->post('/api/Paiement', $paiement);
        $response->assertStatus(200);
        $this->assertNotNull($response);
        $this->assertDatabaseHas('paiements', $paiement);

    }  
         public function testShowUser()
    {
        $id = 1;
        $paiement=Paiement::factory()->count(5)->create();
        $response = $this->get('api/Paiement/' . $id);

        $response->assertStatus(200);

        $jsonResponse =$response->json();
        print_r($jsonResponse);
        $this->assertNotNull($jsonResponse);
        $response->assertStatus(200)
        ->assertJsonStructure([
            'id_Intervenant',
            'id_Etab',
            'VH',
            'Taux_H', 
            'Annee_univ',
            'Semestre',
            'Brut',
            'IR',
        ]);
    }
   public function testIndexPaiement()
    {
        $paiement=Paiement::factory()->count(5)->create();
        $response = $this->get('api/Paiement/');

        $response->assertStatus(200);

        $jsonResponse =$response->json();
        print_r($jsonResponse);
        $this->assertNotNull($jsonResponse);
        $response->assertStatus(200)
        ->assertJsonStructure([
            '*'=>[
            'id_Intervenant',
            'id_Etab',
            'VH',
            'Taux_H', 
            'Annee_univ',
            'Semestre',
            'Brut',
            'IR',
            ]
        ]);
    }
    public function testDestroyPaiement()
    { 
        $id=2;
        $paiement=Paiement::factory()->count(5)->create();
        $response = $this->delete('api/Paiement/'.$id);

        $response->assertStatus(200);

        $jsonResponse =$response->json();
        print_r($jsonResponse);
        $this->assertNotNull($jsonResponse);
    }
    public function testUpdatePaiement()
{
    $userid=1;
    $paiement0=Paiement::factory()->create();

    $paiement1=Paiement::factory()->create();

    $paiement1 = $paiement1->toArray();
    $paiement0 = $paiement0->toArray();
  
    $response = $this->put("/api/Paiement/{$userid}", $paiement1);

    $response->assertStatus(200);
    $this->assertNotNull($response);
    $this->assertDatabaseHas('paiements',$paiement1);
    $this->assertDatabaseMissing('paiements', $paiement0);
    
} 
  
    public function tearDown(): void
    {
        $this->artisan('migrate:rollback');
        parent::tearDown();
    }

}