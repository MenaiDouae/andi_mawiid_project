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
        Schema::create('cabinets', function (Blueprint $table) {
            $table->bigIncrements('id_cabinet');
            $table->text('adresse')->nullable();
            $table->string('fixe')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('id_ville');
            $table->unsignedBigInteger('id_specialite');
            $table->foreign('id_ville')->references('id_ville')->on('villes')->onDelete('cascade');
            $table->foreign('id_specialite')->references('id_specialite')->on('specialites')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabinets');
    }
};
