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

class TestUsercontroller extends TestCase
{

    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }
     public function testStoreAdministrateur()
    {

        $admin=Administrateur::factory()->create();
        $admin = $admin->toArray();
        print_r($admin);
        $response = $this->post('/api/Administrateur', $admin);
        $response->assertStatus(200);
        $this->assertNotNull($response);
        $response->assertStatus(200)
        ->assertJsonStructure([
            'PPR',
            'Nom',
            'prenom',
            'Etablissement',
            'id_user',
        ]);
        $this->assertDatabaseHas('administrateurs', $admin);
        
    }  
          public function testShowAdministrateur()
    {
        $id = 1;
        $admin=Administrateur::factory()->count(5)->create();
        $response = $this->get('api/Administrateur/' . $id);

        $response->assertStatus(200);

        $jsonResponse =$response->json();
        print_r($jsonResponse);
   
        $this->assertNotNull($jsonResponse);
        $response->assertStatus(200)
        ->assertJsonStructure([
            'PPR',
            'Nom',
            'prenom',
            'Etablissement',
            'id_user',
        ]);
    }
   public function testIndexAdministrateur()
    {
        $admin=Administrateur::factory()->count(5)->create();
        $response = $this->get('api/Administrateur/');

        $response->assertStatus(200);

        $jsonResponse =$response->json();
        print_r($jsonResponse);
        $this->assertNotNull($jsonResponse);
        $response->assertStatus(200)
        ->assertJsonStructure([
            '*'=>[
                'PPR',
                'Nom',
                'prenom',
                'Etablissement',
                'id_user',
            ]
        ]);
    }
   public function testDestroyPaiement()
    { 
        $id=2;
        $admin=Administrateur::factory()->count(5)->create();
        $response = $this->delete('api/Administrateur/'.$id);

        $response->assertStatus(200);

        $jsonResponse =$response->json();
        print_r($jsonResponse);
        $this->assertNotNull($jsonResponse);
    }
    public function testUpdatePaiement()
{
    $userid=1;
    $admin0=Administrateur::factory()->create();

    $admin1=Administrateur::factory()->create();

    $admin1 = $admin1->toArray();
    $admin0 = $admin0->toArray();
  
    $response = $this->put("/api/Administrateur/{$userid}", $admin1);

    $response->assertStatus(200);
    $this->assertNotNull($response);
    $this->assertDatabaseHas('administrateurs',$admin1);
    $this->assertDatabaseMissing('administrateurs', $admin0);
    
}  
  
    public function tearDown(): void
    {
        $this->artisan('migrate:rollback');
        parent::tearDown();
    }

}