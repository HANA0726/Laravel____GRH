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
        Schema::create('salaires', function (Blueprint $table) {
            $table->id('id_salaire');
            $table->decimal('salaire_brute', 10, 2);
            $table->decimal('salaire_net', 10, 2)->nullable();
            $table->bigInteger('jours_feriees')->default('0');
            $table->date('date');
            $table->unsignedBigInteger('id_employer');
            $table->foreign('id_employer')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaires');
    }
};
