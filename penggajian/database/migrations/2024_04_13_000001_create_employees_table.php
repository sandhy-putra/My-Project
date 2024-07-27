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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('employee_id', 15)->primary(); // Jadikan primary key
            $table->string('name', 60);
            $table->string('id_card_number', 16);
            $table->date('join_date')->nullable();
            $table->date('birthdate')->nullable(); // Kolom untuk tanggal lahir
            $table->string('tax_identification_number', 16)->nullable();
            $table->string('non_taxable_income_id', 5)->nullable();
            $table->boolean('is_employee_resign')->default(false); 

            // Definisikan foreign key untuk non_taxable_income_id
            $table->foreign('non_taxable_income_id')
                ->references('non_taxable_income_id')
                ->on('non_taxable_incomes')
                ->onDelete('set null'); // Aksi jika data di non_taxable_incomes dihapus

            $table->bigInteger('basic_salary')->nullable();
            $table->bigInteger('bpjs_health')->nullable(); // Kontribusi BPJS Kesehatan
            $table->bigInteger('bpjs_employment')->nullable(); // Kontribusi BPJS Ketenagakerjaan
            $table->timestamps();

            // Buat indeks unik untuk kombinasi kolom-kolom berikut
            $table->unique(['employee_id', 'id_card_number', 'tax_identification_number', 'non_taxable_income_id'], 'unique_employees');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
