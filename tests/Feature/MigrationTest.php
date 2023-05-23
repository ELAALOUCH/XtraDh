<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MigrationTest extends TestCase
{ 
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }
    
    public function testPremieremigrationhh()
    {
        $this->assertTrue(Schema::hasTable('users'));
        $this->assertTrue(Schema::hasColumn('users', 'id_user'));
        $this->assertTrue(Schema::hasColumn('users', 'email'));
        $this->assertTrue(Schema::hasColumn('users', 'password'));
        $this->assertTrue(Schema::hasColumn('users', 'type'));
        $this->assertTrue(Schema::hasColumn('users', 'remember_token'));
        $this->assertTrue(Schema::hasColumn('users', 'created_at'));
        $this->assertTrue(Schema::hasColumn('users', 'updated_at'));  
    }
    public function testDeuxiememigration()
    {
        $this->assertTrue(Schema::hasTable('administrateurs'));
        $this->assertTrue(Schema::hasColumn('administrateurs', 'id'));
        $this->assertTrue(Schema::hasColumn('administrateurs', 'PPR'));
        $this->assertTrue(Schema::hasColumn('administrateurs', 'Nom'));
        $this->assertTrue(Schema::hasColumn('administrateurs', 'prenom'));
        $this->assertTrue(Schema::hasColumn('administrateurs', 'Etablissement'));
        $this->assertTrue(Schema::hasColumn('administrateurs', 'id_user'));
        $this->assertTrue(Schema::hasColumn('administrateurs', 'updated_at'));
        $this->assertTrue(Schema::hasColumn('administrateurs', 'created_at'));

    }
    public function testTroisiememigration()
    {
        $this->assertTrue(Schema::hasTable('etablissements'));
        $this->assertTrue(Schema::hasColumn('etablissements', 'id'));
        $this->assertTrue(Schema::hasColumn('etablissements', 'code'));
        $this->assertTrue(Schema::hasColumn('etablissements', 'Nom'));
        $this->assertTrue(Schema::hasColumn('etablissements', 'Telephone'));
        $this->assertTrue(Schema::hasColumn('etablissements', 'Faxe'));
        $this->assertTrue(Schema::hasColumn('etablissements', 'ville'));
        $this->assertTrue(Schema::hasColumn('etablissements', 'Nbr_enseignants'));
        $this->assertTrue(Schema::hasColumn('etablissements', 'created_at'));
        $this->assertTrue(Schema::hasColumn('etablissements', 'updated_at'));
     
    }
    public function testQuatriememigration()
    {
        $this->assertTrue(Schema::hasTable('grades'));
        $this->assertTrue(Schema::hasColumn('grades', 'id_Grade'));
        $this->assertTrue(Schema::hasColumn('grades', 'designation'));
        $this->assertTrue(Schema::hasColumn('grades', 'charge_statutaire'));
        $this->assertTrue(Schema::hasColumn('grades', 'Taux_horaire_Vocation'));
        $this->assertTrue(Schema::hasColumn('grades', 'created_at'));
        $this->assertTrue(Schema::hasColumn('grades', 'updated_at'));
     
    }
    public function testCinquiememigration()
    {
        $this->assertTrue(Schema::hasTable('enseignants'));
        $this->assertTrue(Schema::hasColumn('enseignants', 'id'));
        $this->assertTrue(Schema::hasColumn('enseignants', 'PPR'));
        $this->assertTrue(Schema::hasColumn('enseignants', 'Nom'));
        $this->assertTrue(Schema::hasColumn('enseignants', 'prenom'));
        $this->assertTrue(Schema::hasColumn('enseignants', 'Date_Naissance'));
        $this->assertTrue(Schema::hasColumn('enseignants', 'Etablissement'));
        $this->assertTrue(Schema::hasColumn('enseignants', 'id_Grade'));
        $this->assertTrue(Schema::hasColumn('enseignants', 'id_user'));
        $this->assertTrue(Schema::hasColumn('enseignants', 'created_at'));
        $this->assertTrue(Schema::hasColumn('enseignants', 'updated_at'));
    }
    public function testSixiememigration()
    {
        $this->assertTrue(Schema::hasTable('interventions'));
        $this->assertTrue(Schema::hasColumn('interventions', 'id_intervention'));
        $this->assertTrue(Schema::hasColumn('interventions', 'id_intervenant'));
        $this->assertTrue(Schema::hasColumn('interventions', 'id_Etab'));
        $this->assertTrue(Schema::hasColumn('interventions', 'intitule_Intervention'));
        $this->assertTrue(Schema::hasColumn('interventions', 'Annee_univ'));
        $this->assertTrue(Schema::hasColumn('interventions', 'Semestre'));
        $this->assertTrue(Schema::hasColumn('interventions', 'Date_debut'));
        $this->assertTrue(Schema::hasColumn('interventions', 'Date_fin'));
        $this->assertTrue(Schema::hasColumn('interventions', 'Nbr_heures'));
        $this->assertTrue(Schema::hasColumn('interventions', 'visa_etb'));
        $this->assertTrue(Schema::hasColumn('interventions', 'visa_uae'));
        $this->assertTrue(Schema::hasColumn('interventions', 'created_at'));
        $this->assertTrue(Schema::hasColumn('interventions', 'updated_at'));
    }
    public function testSeptiememigration()
    {
        $this->assertTrue(Schema::hasTable('paiements'));
        $this->assertTrue(Schema::hasColumn('paiements', 'id'));
        $this->assertTrue(Schema::hasColumn('paiements', 'id_intervenant'));
        $this->assertTrue(Schema::hasColumn('paiements', 'id_Etab'));
        $this->assertTrue(Schema::hasColumn('paiements', 'VH'));
        $this->assertTrue(Schema::hasColumn('paiements', 'Taux_H'));
        $this->assertTrue(Schema::hasColumn('paiements', 'Brut'));
        $this->assertTrue(Schema::hasColumn('paiements', 'IR'));
        $this->assertTrue(Schema::hasColumn('paiements', 'Annee_univ'));
        $this->assertTrue(Schema::hasColumn('paiements', 'Semestre'));
        $this->assertTrue(Schema::hasColumn('paiements', 'created_at'));
        $this->assertTrue(Schema::hasColumn('paiements', 'updated_at'));
    }

    public function tearDown(): void
    {
        $this->artisan('migrate:rollback');
        parent::tearDown();
    }

}
