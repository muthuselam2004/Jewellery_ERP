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
        Schema::create('Sales_Details_Mst', function (Blueprint $table) {
            $table->id();
            $table->string('Ccode');
            $table->string('Lcode');
            $table->string('Date');
            $table->string('Daily_Rate');
            $table->string('Category_Name');
            $table->string('Category_Type');
            $table->string('Manufacturing_Type');
            $table->string('Product_Type');
            $table->string('Item');
            $table->string('Gross_Weight');
            $table->string('Stone_Weight');
            $table->string('Net_Weight');
            $table->string('Purity_Type');
            $table->string('Purity');
            $table->string('Quantity');
            $table->string('Gram');
            $table->string('GST');
            $table->string('CGST');
            $table->string('SGST');
            $table->string('Total_Amount');
            $table->string('Created_By');
            $table->string('Created_Time');
            $table->string('Updated_By');
            $table->string('Updated_Time');
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('Sales_Details_Mst');
    }
};
