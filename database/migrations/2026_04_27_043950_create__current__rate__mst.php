<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   
    public function up(): void
    {
        Schema::create('Current_Rate_Mst', function (Blueprint $table) {
            $table->id();
            $table->string('Ccode');
            $table->string('Lcode');
            $table->string('Metal_Type');
            $table->string('Purity');
            $table->string('Unit');
            $table->string('Rate');
            $table->string('Date');
            $table->string('Created_By');
            $table->string('Created_Time');
            $table->string('Updated_By');
            $table->string('Updated_Time');

            $table->unique(['Metal_Type', 'Purity', 'Date']);
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('Current_Rate_Mst');
    }
};
