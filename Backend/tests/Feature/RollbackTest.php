<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RollbackTest extends TestCase
{ 
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
        $this->artisan('migrate:rollback');
    }
    
    public function testPremieremigrationhh()
    {
        $this->assertFalse(Schema::hasTable('users'));
        $this->assertFalse(Schema::hasColumn('users', 'id_user'));
        $this->assertFalse(Schema::hasColumn('users', 'email'));
        $this->assertFalse(Schema::hasColumn('users', 'password'));
        $this->assertFalse(Schema::hasColumn('users', 'type'));
        $this->assertFalse(Schema::hasColumn('users', 'remember_token'));
        $this->assertFalse(Schema::hasColumn('users', 'created_at'));
        $this->assertFalse(Schema::hasColumn('users', 'updated_at'));  
    }
    public function testDeuxiememigration()
    {
        $this->assertFalse(Schema::hasTable('administrateurs'));
        $this->assertFalse(Schema::hasColumn('administrateurs', 'id'));
        $this->assertFalse(Schema::hasColumn('administrateurs', 'PPR'));
        $this->assertFalse(Schema::hasColumn('administrateurs', 'Nom'));
        $this->assertFalse(Schema::hasColumn('administrateurs', 'prenom'));
        $this->assertFalse(Schema::hasColumn('administrateurs', 'Etablissement'));
        $this->assertFalse(Schema::hasColumn('administrateurs', 'id_user'));
        $this->assertFalse(Schema::hasColumn('administrateurs', 'updated_at'));
        $this->assertFalse(Schema::hasColumn('administrateurs', 'created_at'));

    }
    public function testTroisiememigration()
    {
        $this->assertFalse(Schema::hasTable('etablissements'));
        $this->assertFalse(Schema::hasColumn('etablissements', 'id'));
        $this->assertFalse(Schema::hasColumn('etablissements', 'code'));
        $this->assertFalse(Schema::hasColumn('etablissements', 'Nom'));
        $this->assertFalse(Schema::hasColumn('etablissements', 'Telephone'));
        $this->assertFalse(Schema::hasColumn('etablissements', 'Faxe'));
        $this->assertFalse(Schema::hasColumn('etablissements', 'ville'));
        $this->assertFalse(Schema::hasColumn('etablissements', 'Nbr_enseignants'));
        $this->assertFalse(Schema::hasColumn('etablissements', 'created_at'));
        $this->assertFalse(Schema::hasColumn('etablissements', 'updated_at'));
     
    }
    public function testQuatriememigration()
    {
        $this->assertFalse(Schema::hasTable('grades'));
        $this->assertFalse(Schema::hasColumn('grades', 'id_Grade'));
        $this->assertFalse(Schema::hasColumn('grades', 'designation'));
        $this->assertFalse(Schema::hasColumn('grades', 'charge_statutaire'));
        $this->assertFalse(Schema::hasColumn('grades', 'Taux_horaire_Vocation'));
        $this->assertFalse(Schema::hasColumn('grades', 'created_at'));
        $this->assertFalse(Schema::hasColumn('grades', 'updated_at'));
     
    }
    public function testCinquiememigration()
    {
        $this->assertFalse(Schema::hasTable('enseignants'));
        $this->assertFalse(Schema::hasColumn('enseignants', 'id'));
        $this->assertFalse(Schema::hasColumn('enseignants', 'PPR'));
        $this->assertFalse(Schema::hasColumn('enseignants', 'Nom'));
        $this->assertFalse(Schema::hasColumn('enseignants', 'prenom'));
        $this->assertFalse(Schema::hasColumn('enseignants', 'Date_Naissance'));
        $this->assertFalse(Schema::hasColumn('enseignants', 'Etablissement'));
        $this->assertFalse(Schema::hasColumn('enseignants', 'id_Grade'));
        $this->assertFalse(Schema::hasColumn('enseignants', 'id_user'));
        $this->assertFalse(Schema::hasColumn('enseignants', 'created_at'));
        $this->assertFalse(Schema::hasColumn('enseignants', 'updated_at'));
    }
    public function testSixiememigration()
    {
        $this->assertFalse(Schema::hasTable('interventions'));
        $this->assertFalse(Schema::hasColumn('interventions', 'id_intervention'));
        $this->assertFalse(Schema::hasColumn('interventions', 'id_intervenant'));
        $this->assertFalse(Schema::hasColumn('interventions', 'id_Etab'));
        $this->assertFalse(Schema::hasColumn('interventions', 'intitule_Intervention'));
        $this->assertFalse(Schema::hasColumn('interventions', 'Annee_univ'));
        $this->assertFalse(Schema::hasColumn('interventions', 'Semestre'));
        $this->assertFalse(Schema::hasColumn('interventions', 'Date_debut'));
        $this->assertFalse(Schema::hasColumn('interventions', 'Date_fin'));
        $this->assertFalse(Schema::hasColumn('interventions', 'Nbr_heures'));
        $this->assertFalse(Schema::hasColumn('interventions', 'visa_etb'));
        $this->assertFalse(Schema::hasColumn('interventions', 'visa_uae'));
        $this->assertFalse(Schema::hasColumn('interventions', 'created_at'));
        $this->assertFalse(Schema::hasColumn('interventions', 'updated_at'));
    }
    public function testSeptiememigration()
    {
        $this->assertFalse(Schema::hasTable('paiements'));
        $this->assertFalse(Schema::hasColumn('paiements', 'id'));
        $this->assertFalse(Schema::hasColumn('paiements', 'id_intervenant'));
        $this->assertFalse(Schema::hasColumn('paiements', 'id_Etab'));
        $this->assertFalse(Schema::hasColumn('paiements', 'VH'));
        $this->assertFalse(Schema::hasColumn('paiements', 'Taux_H'));
        $this->assertFalse(Schema::hasColumn('paiements', 'Brut'));
        $this->assertFalse(Schema::hasColumn('paiements', 'IR'));
        $this->assertFalse(Schema::hasColumn('paiements', 'Annee_univ'));
        $this->assertFalse(Schema::hasColumn('paiements', 'Semestre'));
        $this->assertFalse(Schema::hasColumn('paiements', 'created_at'));
        $this->assertFalse(Schema::hasColumn('paiements', 'updated_at'));
    }

}