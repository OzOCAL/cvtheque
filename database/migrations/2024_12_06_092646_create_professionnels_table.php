<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('professionnels', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Identifiant professionnel');
            $table->string('prenom', 25)->comment("Prénom du professionnel");
            $table->string('nom', 40)->comment("Nom du professionnel");
            $table->string('cp', 5)->comment("Code postal du professionnel");
            $table->string('ville', 38)->comment("Ville");
            $table->string('tel', 14)->comment("Téléphone fixe ou portable");
            $table->string('email', 255)->unique()->comment("Adresse mail");
            $table->date('naissance')->comment("Date de naissance");
            $table->boolean('formation')->comment("Action de formation déjà effectuée OUI / NON");
            $table->set('domaine', ['S', 'R', 'D'])->comment("Domaine d'activité entre Système, Recherche et/ou Développeement");
            $table->string('source', 255)->nullable()->comment("Source (réseaux, organisme partenaire, presse, ...");
            $table->text('observation')->nullable()->comment("Observation / Commandaire");
            $table->timestamps();
            $table->unsignedBigInteger('metier_id');
            $table->foreign('metier_id')
                ->references('id')
                ->on('metiers')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professionnels');
    }
};
