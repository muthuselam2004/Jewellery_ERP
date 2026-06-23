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
        Schema::create('Supplier_Mst', function (Blueprint $table) {
            $table->id();
            $table->string('Ccode');
            $table->string('Lcode');
            $table->string('Supplier_Code');
            $table->string('Supplier_Name');
            $table->string('Company_Name');
            $table->string('Supplier_Type');
            $table->string('Metal_Type');
            $table->string('Status');
            $table->string('Mobile');
            $table->string('Alt_Mobile');
            $table->string('Email');
            $table->string('Contact_Person');
            $table->string('Address');
            $table->string('Alt_Address');
            $table->string('City');
            $table->string('State');
            $table->string('Pincode');
            $table->string('Country');
            $table->string('GST');
            $table->string('Pan_No');
            $table->string('Opening_Balance');
            $table->string('Balance_Type');
            $table->string('Credit_Limit');
            $table->string('Payment_Terms');
            $table->string('Bank_Name');
            $table->string('IFSC');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Supplier_Mst');
    }
};
