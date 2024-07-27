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
        Schema::create('tax_categories', function (Blueprint $table) {
            $table->string('tax_category_id',5)->primary();
            $table->bigInteger('min_gross_income');
            $table->bigInteger('max_gross_income');
            $table->decimal('tax_rate', 10, 2);
            $table->string('effective_average_tax_rate_category',1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax_categories');
    }
};
