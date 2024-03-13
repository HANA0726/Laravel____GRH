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
        Schema::create('conge_soldes', function (Blueprint $table) {
            $table->id('id_solde');
            $table->unsignedBigInteger('id_employer');
            $table->foreign('id_employer')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('solde')->default('20');
            $table->bigInteger('solde_reel')->default('20');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conge_soldes');
    }
};
