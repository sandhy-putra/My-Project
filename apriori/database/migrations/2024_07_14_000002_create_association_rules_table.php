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
        Schema::create('association_rules', function (Blueprint $table) {
            $table->id();
            $table->string('period',6);
            $table->string('antecedent'); // Antecedent dari aturan asosiasi
            $table->string('consequent'); // Consequent dari aturan asosiasi
            $table->decimal('confidence', 8, 2); // Tingkat kepercayaan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('association_rules');
    }
};
