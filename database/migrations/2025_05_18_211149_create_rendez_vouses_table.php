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
        Schema::create('rendez_vous', function (Blueprint $table) {
            $table->bigIncrements('id_rendez_vous');
            $table->date('date_rendez_vous');
            $table->time('heure_rendez_vous');
            $table->tinyInteger('etat')->comment('0: Annulé, 1: Confirmé, 2: Terminée, null: En attente')->nullable()->default(null);
            $table->unsignedBigInteger('id_patient');
            $table->unsignedBigInteger('id_service');
            $table->foreign('id_patient')->references('id_patient')->on('patients')->onDelete('cascade');
            $table->foreign('id_service')->references('id_service')->on('services')->onDelete('cascade');
            $table->text('commentaire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendez_vous');
    }
};
