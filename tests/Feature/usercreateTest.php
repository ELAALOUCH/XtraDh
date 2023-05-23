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
use Illuminate\Database\Eloquent\Factories\HasFactory;

class testons extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->artisan('migrate');
    }
public function testCreateUsers()

{ 
    $users = User::factory()->count(10)->create();
    echo $users[0]['email'];
    $users = etablissement::factory()->count(10)->create();
    $users = grade::factory()->count(5)->create();
    $users = Intervention::factory()->count(10)->create();
    $users = Paiement::factory()->count(10)->create();
    $users = Administrateur::factory()->count(10)->create();
    $users = Enseignant::factory()->count(10)->create();
    
    }
    public function tearDown(): void
    {
        $this->artisan('migrate:rollback');
        parent::tearDown();
    }


}
?>
