<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    
    public function up(): void
    {
        Schema::create('Payment_History_Mst', function (Blueprint $table) {
            $table->id();
            $table->string('Ccode');
            $table->string('Lcode');
            $table->date('Date');
            $table->string('Customer_Name');
            $table->string('Customer_Mobile');
            $table->string('Customer_Address');
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
            $table->string('Wastage');
            $table->string('Making_Charges');
            $table->string('Rate');
            $table->string('GST');
            $table->string('CGST');
            $table->string('SGST');
            $table->string('Total_Amount');
            $table->string('Invoice_No');
            $table->string('Received_By');
            $table->string('Card_Type');
            $table->string('Card_Number');
            $table->string('Transaction_ID');
            $table->string('UPI_Mode');
            $table->string('UPI_ID');
            $table->string('Payment_Mode');
            $table->string('Bank_Name');
            $table->string('Account_Number');
            $table->string('Transaction_Ref_No');
            $table->string('Cheque_Number');
            $table->date('Cheque_Date');
            $table->string('Payment_Type');
            $table->string('Advance_Amount');
            $table->string('Paid_Amount');
            $table->string('Pending_Amount');
            $table->string('Return_Amount');
            $table->string('Payment_Status');
            $table->date('Payment_Date');
            $table->string('Receipt_Number');
            $table->string('Created_By');
            $table->timestamp('Created_Time');
            $table->string('Updated_By');
            $table->timestamp('Updated_Time');
        });
    }
      


    public function down(): void
    {
        Schema::dropIfExists('Payment_History_Mst');
    }
};
