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
        Schema::create('primes', function (Blueprint $table) {
            $table->id('id_prime');
            $table->string('designation');
            $table->decimal('montant', 10, 2);
            $table->unsignedBigInteger('id_employer');
            $table->foreign('id_employer')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_salaire');
            $table->foreign('id_salaire')->references('id_salaire')->on('salaires')->onDelete('cascade');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primes');
    }
};
