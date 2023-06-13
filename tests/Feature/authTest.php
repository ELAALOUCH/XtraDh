<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Sanctum;

use Tests\TestCase;
use App\Models\User;

class Testauthcontroller extends TestCase
{
     use DatabaseMigrations;

     public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $type = "Enseignant";
        $email = "testtest666@testing.com";
        $password = "test";

        $response = $this->post('/api/user', [
            'type' => $type,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
        ]);

    }
      public function testauthRegistration()
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
 
    public function testAuthLoginOn()
    {
        $email = "testtest666@testing.com";
        $password = "test";

        $response = $this->post('/api/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertStatus(202);

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
      public function testAuthLoginOffPassword()
    {
       
        $email = "testtest666@testing.com";
        $password = "testfalse";

        $response = $this->post('/api/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertStatus(401);

    }

    public function testAuthLoginOffEmail()
    {

        $email = "testtestfalse@testing.com";
        $password = "test";

        $response = $this->post('/api/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertStatus(401);
    } 
    public function testLogout()
    {
        $email = "testtest666@testing.com";
        $password = "test";

        $response = $this->post('/api/login', [
            'email' => $email,
            'password' => $password,
        ]);
        echo $response['token'];

        $response->assertStatus(202);
        $token = $response['token'];
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/logout');
        // 2ème méthode en utilisant le bypasse fournit par Sanctum ( très bonne méthode, solution ultime pour le reste de mes codes xd)
        /* $user = User::factory()->create([
            'email' => 'oldemail@example.com',
            'password' => bcrypt('oldpassword'),
            'type' => 'oldtype',
        ]);

        Sanctum::actingAs($user);
        $response = $this->post('/api/logout');
        $response->assertStatus(200);
   */
        $response->assertStatus(200)
            ->assertExactJson(['message' => 'Logged out']);
    } 
     public function tearDown(): void
    {
        $this->artisan('migrate:rollback');
        parent::tearDown();
    }  
}

?>