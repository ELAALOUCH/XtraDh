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
use Laravel\Sanctum\Sanctum;

class TestAdministrateurcontroller extends TestCase
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
        $response = $this->post('/api/administrateur', $admin);
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
        $response = $this->get('api/administrateur/' . $id);

        $response->assertStatus(200);

        $jsonResponse =$response->json();
        print_r($jsonResponse);
   
        $this->assertNotNull($jsonResponse);
        $response->assertStatus(200)
        ->assertJsonStructure([
            'PPR',
            'Nom',
            'prenom',
            'id_user',
        ]);
    }
   public function testIndexAdministrateur()
    {
        $admin=Administrateur::factory()->count(5)->create();
        $response = $this->get('api/administrateur/');

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
    
   public function testDestroyAdministrateur()
    { 
        $id=2;
        $admin=Administrateur::factory()->count(5)->create();
        $response = $this->delete('api/administrateur/'.$id);

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
  
    $response = $this->put("/api/administrateur/{$userid}", $admin1);

    $response->assertStatus(200);
    $this->assertNotNull($response);
    $this->assertDatabaseHas('administrateurs',$admin1);
    $this->assertDatabaseMissing('administrateurs', $admin0);
    
}   
    public function testIndexEtbAdministrateur(){
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
        $type = "admin_etb";
        $email = "testtest666@testing.com";
        $password = "test";
        $user = $this->post('/api/user', [
            'type' => $type,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);
        $user->assertStatus(202);
        $PPR = "123456";
        $Nom = "Doe";
        $Prenom = "John";
        $DateNaissance = "1990-01-01";
        $Etablissement = 1; 
        $idUser = 1; 
        
        $response = $this->post('/api/administrateur', [
            'PPR' => $PPR,
            'Nom' => $Nom,
            'prenom' => $Prenom,
            'Etablissement' => $Etablissement,
            'id_user' => $idUser,
        ]);
        $response->assertStatus(200);
        
        $token=$user['token'];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/directeuretab');
        $response->assertStatus(200);
        
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
  
    public function tearDown(): void
    {
        $this->artisan('migrate:rollback');
        parent::tearDown();
    }

}