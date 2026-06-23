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
        Schema::create('Item_Mst', function (Blueprint $table) {
            $table->id();
            $table->string('Ccode');
            $table->string('Lcode');
            $table->string('Item_Code')->unique();
            $table->string('Category_Name');
            $table->string('Category_Type');
            $table->string('Manufacturing_Type');
            $table->string('Product_Type');
            $table->string('Karat');
            $table->string('Purity')->nullable();
            $table->decimal('Gross_Weight', 10, 3);
            $table->decimal('Stone_Weight', 10, 3)->default(0);
            $table->decimal('Net_Weight', 10, 3);
            $table->string('Jwl_Image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Item_Mst');
    }
};
