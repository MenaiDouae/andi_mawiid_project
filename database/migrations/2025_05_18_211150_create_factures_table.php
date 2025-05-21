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
        Schema::create('factures', function (Blueprint $table) {
            $table->bigIncrements('id_facture');
            $table->tinyInteger('etat')->comment('0: Non payé, 1: Payé, 2: Annulé')->default(0);
            $table->timestamp('date_facture')->nullable()->default(null);
            $table->tinyInteger('type_paiement')->comment('0: Espèce, 1: Chèque, 2: Carte bancaire')->default(0);
            $table->unsignedBigInteger('id_rendez_vous');
            $table->foreign('id_rendez_vous')->references('id_rendez_vous')->on('rendez_vous')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
