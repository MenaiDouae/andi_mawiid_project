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
        Schema::create('traitements', function (Blueprint $table) {
            $table->bigIncrements('id_traitement');
            $table->unsignedBigInteger('id_service');
            $table->unsignedBigInteger('id_facture');
            $table->foreign('id_service')->references('id_service')->on('services')->onDelete('cascade');
            $table->foreign('id_facture')->references('id_facture')->on('factures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traitements');
    }
};
