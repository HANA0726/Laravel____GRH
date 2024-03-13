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
        Schema::create('presences', function (Blueprint $table) {
            $table->id('id_presence');
            $table->date('date');
            $table->time('entry_time');
            $table->time('exit_time');
            $table->unsignedBigInteger('id_employer');
            $table->foreign('id_employer')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['id_employer', 'date']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
