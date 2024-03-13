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
        Schema::create('conges', function (Blueprint $table) {
            $table->id('id_conge');
            $table->string('type_conge');
            $table->unsignedBigInteger('id_employer');
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->bigInteger('nbre_jours')->nullable();
            $table->date('date_envoie')->nullable();
            $table->string('status')->default('en cours');
            $table->foreign('id_employer')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
