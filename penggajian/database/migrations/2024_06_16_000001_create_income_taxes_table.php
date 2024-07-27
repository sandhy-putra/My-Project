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
        Schema::create('income_taxes', function (Blueprint $table) {
            $table->string('tax_period', 6);
            $table->string('employee_id', 15);
            $table->string('non_taxable_income_id', 5);
            $table->string('effective_average_tax_rate_category', 1);
            $table->bigInteger('basic_salary')->nullable();
            $table->bigInteger('bpjs_health')->nullable(); // Kontribusi BPJS Kesehatan
            $table->bigInteger('bpjs_employment')->nullable(); // Kontribusi BPJS Ketenagakerjaan
            $table->bigInteger('bonus')->default(0); // Tambahkan kolom bonus
            $table->string('bonus_remark')->nullable();
            $table->bigInteger('other_deductions')->default(0); // Tambahkan kolom potongan lain-lain
            $table->string('other_deductions_remark')->nullable();
            $table->bigInteger('gross_income')->default(0);
            $table->bigInteger('functional_expenses')->default(0);
            $table->decimal('tax_rate', 10, 2);
            $table->bigInteger('income_tax_value')->default(0);
            $table->bigInteger('difference')->default(0);
            $table->boolean('is_last_period')->default(false); // Tambahkan kolom is_last_period
            $table->timestamps();

            // Set primary key
            $table->primary(['tax_period', 'employee_id', 'non_taxable_income_id']);

            // Foreign key constraints
            $table->foreign('employee_id')
                ->references('employee_id')
                ->on('employees')
                ->onDelete('cascade');

            $table->foreign('non_taxable_income_id')
                ->references('non_taxable_income_id')
                ->on('non_taxable_incomes')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_taxes');
    }
};
