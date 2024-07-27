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
        Schema::create('non_taxable_incomes', function (Blueprint $table) {
            $table->string('non_taxable_income_id',5)->primary();
            $table->string('non_taxable_income_status_shortname',4)->unique();
            $table->string('non_taxable_income_status_name',50);
            $table->string('effective_average_tax_rate_category',1);
            $table->bigInteger('non_taxable_income_status_value')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('non_taxable_incomes');
    }
};
