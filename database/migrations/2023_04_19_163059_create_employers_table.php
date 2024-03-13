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
        Schema::create('employers', function (Blueprint $table) {
            $table->id('id_employer');
            $table->foreign('id_employer')->references('id')->on('users')->onDelete('cascade');
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('email')->unique();
            $table->string('telephone', 10)->nullable();
            $table->string('cnss', 12)->nullable();
            $table->string('cin',8)->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('poste')->nullable();
            $table->string('sexe')->nullable();
            $table->string('situation_familiale')->nullable();
            $table->string('photo')->nullable();
            $table->string('type_contrat')->nullable();
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
