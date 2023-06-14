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
        $response = $this->post('/api/paiement', $paiement);
        $response->assertStatus(200);
        $this->assertNotNull($response);
        $this->assertDatabaseHas('paiements', $paiement);

    }  
         public function testShowUser()
    {
        $id = 1;
        $paiement=Paiement::factory()->count(5)->create();
        $response = $this->get('api/paiement/' . $id);

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
        $response = $this->get('api/paiement/');

        $response->assertStatus(200);

        $jsonResponse =$response->json();
        echo"lol";
        print_r($jsonResponse);
        $this->assertNotNull($jsonResponse);

        $response->assertStatus(200)
        ->assertJsonStructure([
            '*'=>[
            'VH',
            'Taux_H', 
            'Annee_univ',
            'Semestre',
            'Brut',
            'IR',
            'NET',
            ]
        ]);
    }
    public function testDestroyPaiement()
    { 
        $id=2;
        $paiement=Paiement::factory()->count(5)->create();
        $response = $this->delete('api/paiement/'.$id);

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
  
    $response = $this->put("/api/paiement/{$userid}", $paiement1);

    $response->assertStatus(200);
    $this->assertNotNull($response);
    $this->assertDatabaseHas('paiements',$paiement1);
    $this->assertDatabaseMissing('paiements', $paiement0);
    
} 

public function testConsultPaiementEtabDirecteur()
{
    
    $user = User::factory()->create();
    $this->actingAs($user);

   
    $admin = Administrateur::factory()->create([
        'id_user' => $user->id_user,
    ]);
    $etb = $admin->Etablissement;
    
    $date='2022/2023';
    $paiement1 = Paiement::factory()->create([
        'id_Etab' => $etb,
        'Annee_univ' => $date,
    ]);
    $paiement2 = Paiement::factory()->create([
        'id_Etab' => $etb,
        'Annee_univ' => $date,
    ]);
    $response = $this->get('api/consultpaiementetabdirecteur');
    $response->assertStatus(200);

}
  
    public function tearDown(): void
    {
        $this->artisan('migrate:rollback');
        parent::tearDown();
    }

}