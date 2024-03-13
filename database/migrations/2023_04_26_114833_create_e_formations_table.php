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
        Schema::create('e_formations', function (Blueprint $table) {
            $table->unsignedBigInteger('id_formation');
                $table->unsignedBigInteger('id_employer');
                $table->foreign('id_formation')->references('id_formation')->on('formations')->onDelete('cascade');
                $table->foreign('id_employer')->references('id')->on('users')->onDelete('cascade');
                $table->primary(['id_employer', 'id_formation']);
                $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_formations');
    }
};
