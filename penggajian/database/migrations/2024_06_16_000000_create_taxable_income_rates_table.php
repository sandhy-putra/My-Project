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
        Schema::create('taxable_income_rates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('min_taxable_income');
            $table->bigInteger('max_taxable_income');
            $table->bigInteger('taxable_income_rate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxable_income_rates');
    }
};
