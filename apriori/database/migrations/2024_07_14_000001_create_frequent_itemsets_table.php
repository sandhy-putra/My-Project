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
        Schema::create('frequent_itemsets', function (Blueprint $table) {
            $table->id();
            $table->string('period',6);
            $table->string('itemset',150); // Itemset yang sering muncul
            $table->integer('support_count'); // Jumlah dukungan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frequent_itemsets');
    }
};
