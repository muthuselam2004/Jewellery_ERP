<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('stock_inward_mst', function (Blueprint $table) {
            $table->id();
            $table->string('Ccode');
            $table->string('Lcode');
            $table->string('Inward_No');
            $table->date('Inward_Date');
            $table->string('Supplier_Code');
            $table->string('Supplier_Name');
            $table->string('Invoice_No');
            $table->string('Location');
            $table->string('Received_By');
            $table->string('Item_Code');
            $table->string('Category_Name');
            $table->string('Category_Type');
            $table->string('Manufacturing_Type');
            $table->string('Product_Type');
            $table->string('Item_Name');
            $table->string('Gross_Weight');
            $table->string('Net_Weight');
            $table->string('Purity');
            $table->string('Quantity');
            $table->string('Making_Charges');
            $table->string('Rate');
            $table->string('Amount');
            $table->string('Quality_Control');
            $table->string('Created_By');
            $table->string('Created_Time');
            $table->string('Updated_By');
            $table->string('Updated_Time');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('stock_inward_mst');
    }
};
