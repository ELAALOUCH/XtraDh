<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Controllers\UserController;
use Tests\TestCase;
use App\Models\User;
use App\Models\enseignant;
use App\Models\Administrateur;
use Laravel\Sanctum\Sanctum;
class TestUsercontroller extends TestCase
{

      use DatabaseMigrations; 

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
         $type = "Enseignant";
        $email = "testtest1@testing.com";
        $password = "test";

        $response = $this->post('/api/user', [
            'type' => $type,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);
        $type = "haha";
        $email = "testtest2@testing.com";
        $password = "test";

        $response = $this->post('/api/user', [
            'type' => $type,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]); 
    } 
     public function testUserStore()
    {

        $type = "Enseignant";
        $email = "testtest@testing.com";
        $password = "test";

        $response = $this->post('/api/user', [
            'type' => $type,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertStatus(202);

        $this->assertDatabaseHas('users', [
            'type' => $type,
            'email' => $email,
        ]);

        $response->assertJsonStructure([
            'user' => [
                'id_user',
                'type',
                'email',
                'created_at',
                'updated_at',
            ],
            'token',
        ]);

        $this->assertNotEmpty($response['token']);
    } 
        public function testShowUser()
    {
        $id = 1;

        $response = $this->get('api/user/' . $id);

        $response->assertStatus(200);

        $jsonResponse = $response->json();
        $response->assertStatus(200)
        ->assertJsonStructure([
                'id_user',
                'email',
                'type',
                'created_at',
                'updated_at',
        ]);
    }
    public function testIndexUser()
    {
        $response = $this->get('api/user');

        $response->assertStatus(200);

        $jsonResponse = $response->json();
        print_r($jsonResponse);
        
        $response->assertStatus(200)
        ->assertJsonStructure([
            '*' => [
                'id_user',
                'email',
                'type',
                'created_at',
                'updated_at',
            ],
        ]);
    }
    public function testDestroyUser()
    {   
        $userId=2;
        $response = $this->delete('/api/user/' . $userId);
        
        $response->assertStatus(200);
        $this->assertDatabaseMissing('users', ['id_user' => $userId]);
    }
    public function testUpdateUser()
{
    $user = User::factory()->create([
        'email' => 'oldemail@example.com',
        'password' => bcrypt('oldpassword'),
        'type' => 'oldtype',
    ]);
    Sanctum::actingAs($user);
    $userid=$user->id_user;
 
    $response = $this->put('/api/user/'.$userid, [
        'email' => 'newemail@example.com',
        'password' => 'newpassword',
        'type' => 'newtype',
    ]);
    $response->assertStatus(202);
    $this->assertDatabaseHas('users', [
        'id_user' => $userid,
        'email' => 'newemail@example.com',
        'type' => 'newtype',
    ]);

 }
// public function testIndexEtbAdministrateur(){
//     $code = "la123";
//     $Nom = "Groupe scolaire L'élite";
//     $Telephone = "0655967517";
//     $Faxe = "418 643‑3210";
//     $ville = "Casanegra";
//     $Nbr_enseignants = 50;

//     $response = $this->post('/api/etablissement', [
//         'code'=> $code,
//         'Nom'=> $Nom,
//         'Telephone'=> $Telephone,
//         'Faxe'=> $Faxe,
//         'ville'=> $ville,
//         'Nbr_enseignants'=> $Nbr_enseignants,
//     ]);
//     $type = "admin_etb";
//     $email = "testtest666@testing.com";
//     $password = "test";
//     $user = $this->post('/api/user', [
//         'type' => $type,
//         'email' => $email,
//         'password' => $password,
//         'password_confirmation' => $password,
//     ]);
//     $user->assertStatus(202);
//     $PPR = "123456";
//     $Nom = "tester";
//     $Prenom = "test";
//     $DateNaissance = "1990-01-01";
//     $Etablissement = 1; 
//     $idUser = 3; 
    
//     $response = $this->post('/api/administrateur', [
//         'PPR' => $PPR,
//         'Nom' => $Nom,
//         'prenom' => $Prenom,
//         'Etablissement' => $Etablissement,
//         'id_user' => $idUser,
//     ]);
//     $response->assertStatus(200);
    
//     $token=$user['token'];
//     $response = $this->withHeaders([
//         'Authorization' => 'Bearer ' . $token,
//     ])->get('/api/adminetb');
//     $response->assertStatus(200);
    
//     $response->assertStatus(200)
//     ->assertJsonStructure([
//         '*'=>[
//             'PPR',
//             'Nom',
//             'prenom',
//             'Etablissement',
//             'id_user',
//         ]
//     ]);
// } 
public function testStoreAdministrateurEtb(){
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
    $designation = "Grade T";
    $charge_statutaire = "50";
    $Taux_horaire_Vocation = "100";

    $response = $this->post('/api/grade', [
        'designation'=> $designation,
        'charge_statutaire'=> $charge_statutaire,
        'Taux_horaire_Vocation'=> $Taux_horaire_Vocation,
    ]);
    $user->assertStatus(202);
    $PPR = "123456";
    $Nom = "tester";
    $Prenom = "test";
    $Etablissement = 1; 
    $idUser = 3; 
    
    $response = $this->post('/api/administrateur', [
        'PPR' => $PPR,
        'Nom' => $Nom,
        'prenom' => $Prenom,
        'Etablissement' => $Etablissement,
        'id_user' => $idUser,
    ]);
    $PPR = "123455";
    $Nom = "tester";
    $Prenom = "test";
    $DateNaissance = "1990-01-01";
    $id_Grade=1;
    $email="testtaha666@mail.com";
    $type="prof";
    $response->assertStatus(201);
    
    $token=$user['token'];
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('/api/storeadminetb', [
        'PPR' => $PPR,
        'Nom' => $Nom,
        'prenom' => $Prenom,
        'email'=>$email,
        'type'=>$type,
    ]);
    $response->assertStatus(202);
    $response=$response->json();
    print_r($response);
    $this->assertDatabaseHas('users',[
        'email' => $email,
        'type' => $type,
    ]);
}
public function testStoreEnseignantEtb(){
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
    $designation = "Grade T";
    $charge_statutaire = "50";
    $Taux_horaire_Vocation = "100";

    $response = $this->post('/api/grade', [
        'designation'=> $designation,
        'charge_statutaire'=> $charge_statutaire,
        'Taux_horaire_Vocation'=> $Taux_horaire_Vocation,
    ]);
    $user->assertStatus(202);
    $PPR = "123456";
    $Nom = "tester";
    $Prenom = "test";
    $Etablissement = 1; 
    $idUser = 3; 
    
    $response = $this->post('/api/administrateur', [
        'PPR' => $PPR,
        'Nom' => $Nom,
        'prenom' => $Prenom,
        'Etablissement' => $Etablissement,
        'id_user' => $idUser,
    ]);
    $PPR = "123455";
    $Nom = "tester";
    $Prenom = "test";
    $DateNaissance = "1990-01-01";
    $id_Grade=1;
    $email="testtaha666@mail.com";
    $type="admin";
    $response->assertStatus(201);
    
    $token=$user['token'];
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('/api/storeprofetb', [
        'PPR' => $PPR,
        'Nom' => $Nom,
        'prenom' => $Prenom,
        'Date_Naissance'=>$DateNaissance,
        'id_Grade'=>$id_Grade,
        'email'=>$email,
        'type'=>$type,
    ]);
    $response->assertStatus(202);
    $response=$response->json();
    print_r($response);
    $this->assertDatabaseHas('users',[
        'email' => $email,
        'type' => $type,
    ]);
}
    public function testUpdateProf(){
        $user = User::factory()->create([
            'email' => 'oldemail@example.com',
            'password' => bcrypt('oldpassword'),
            'type' => 'oldtype',
        ]);
        Sanctum::actingAs($user);
        $prof=enseignant::factory()->create();
        $id=$prof['id_user'];
        $response = $this->patch('/api/updateprof/'.$id, [
            'email' => 'newemail@example.com',
            'password' => 'newpassword',
            'type' => 'newtype',
            'PPR' => '666666',
            'Nom' => 'testcheck',
            'prenom'=>'retestcheck',
            'Date_Naissance' => "1980-01-01",
            'Etablissement' => 1,
            'id_Grade' => 1,
        ]);
        $response->assertStatus(202);
        $this->assertDatabaseHas('enseignants', [
            'id_user' => $id,
            'PPR' => '666666',
            'Nom' => 'testcheck',
            'prenom'=>'retestcheck',
            'Date_Naissance' => "1980-01-01",
            'Etablissement' => 1,
            'id_Grade' => 1,
        ]);
    
    }
    public function testUpdateAdmin(){
        $user = User::factory()->create([
            'email' => 'oldemail@example.com',
            'password' => bcrypt('oldpassword'),
            'type' => 'oldtype',
        ]);
        Sanctum::actingAs($user);
        $admin=Administrateur::factory()->create();
        $id=$admin['id_user'];
        $response = $this->patch('/api/updateadm/'.$id, [
            'id_user' => $id,
            'email' => 'newemail@example.com',
            'password' => 'newpassword',
            'type' => 'newtype',
            'PPR' => '666666',
            'Nom' => 'testcheck',
            'Etablissement' => 1,
            'prenom'=>'retestcheck',
        ]);
        $response->assertStatus(202);
        $this->assertDatabaseHas('administrateurs', [
            'id_user' => $id,
            'PPR' => '666666',
            'Nom' => 'testcheck',
            'prenom'=>'retestcheck',
            'Etablissement' => 1,
        ]);
    
    }
    public function testDestroyProf()
{   
    $prof=enseignant::factory()->create();
    $id=$prof['id_user'];
    $response = $this->delete('/api/deleteprof/' . $id);
    $response->assertStatus(202);
    $this->assertDatabaseMissing('enseignants', ['id' => $id]);
}
public function testDestroyAdmin()
{   
    $admin=Administrateur::factory()->create();
    $id=$admin['id_user'];
    $response = $this->delete('/api/deleteadm/' . $id);
    $response->assertStatus(202);
    $this->assertDatabaseMissing('administrateurs', ['id' => $id]);
}
public function testAjoutIntervention()
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
        $Etablissement = 1; 
        $idGrade = 1; 
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
    
    
        $type = "admin_etb";
        $email = "testtest666@testing.com";
        $password = "test";
        $user = $this->post('/api/user', [
        'type' => $type,
        'email' => $email,
        'password' => $password,
        'password_confirmation' => $password,
    ]);
    $token=$user['token'];
    $PPR = "123456";
    $Nom = "tester";
    $Prenom = "test";
    $Etablissement = 1; 
    $idUser = 3; 
    
    $response = $this->post('/api/administrateur', [
        'PPR' => $PPR,
        'Nom' => $Nom,
        'prenom' => $Prenom,
        'Etablissement' => $Etablissement,
        'id_user' => $idUser,
    ]);
echo $token;
    $PPR = "123456789";
    $response = $this->withHeaders([
        'Authorization' => 'Bearer ' . $token,
    ])->post('/api/ajoutinterventionetab', [
        'PPR'=> $PPR,
        'id_Intervenant' => $id_Intervenant,
        'id_etab' => $id_Etab,
        'Intitule_Intervention' => $Intitule_Intervention,
        'Annee_univ' => $Annee_univ,
        'Semestre' => $Semestre,
        'Date_debut' => $Date_debut,
        'Date_fin' => $Date_fin,
        'Nbr_heures' => $Nbr_heures
    ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('interventions', [
         "id_intervention" => 1,
          "id_Intervenant"=> 1,
          "id_Etab"=> 1,
          "Intitule_Intervention"=> "Test Intervention",
          "Annee_univ"=> "2022-2023",
          "Semestre"=> "automne",
          "Date_debut"=> "2023-01-01",
          "Date_fin"=> "2023-02-28",
          "Nbr_heures"=> 40,
          "visa_etb"=> 0,
          "visa_uae"=> 0,
        ]);

        $this->assertNotNull($response);
    } 
      public function tearDown(): void
    {
        $this->artisan('migrate:rollback');
        parent::tearDown();
    }  

}