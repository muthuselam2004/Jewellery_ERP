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
        Schema::create('Purity_Mst', function (Blueprint $table) {
            $table->string('Ccode');
            $table->string('Lcode');
            $table->string('Metal_Type');
            $table->string('Purity');
            $table->string('Value');
            $table->string('Created_By');
            $table->string('Created_Time');
            $table->string('Updated_By');
            $table->string('Updated_Time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Purity_Mst');
    }
};
