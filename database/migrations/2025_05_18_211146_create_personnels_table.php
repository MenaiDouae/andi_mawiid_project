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
        Schema::create('personnels', function (Blueprint $table) {
            $table->bigIncrements('id_patient');
            $table->string('nom', 255);
            $table->string('prenom', 255);
            $table->string('cnie', 20)->unique()->nullable();
            $table->text('adresse')->nullable();
            $table->string('num_tel', 20)->nullable();
            $table->tinyInteger('sexe')->comment('1: Masculin, 2: Féminin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnels');
    }
};
