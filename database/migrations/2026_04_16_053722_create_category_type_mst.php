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
        Schema::create('Category_Type_Mst', function (Blueprint $table) {
            $table->id();
            $table->string('Ccode');
            $table->string('Lcode');
            $table->string('Medel_ID');
            $table->string('Medel_Type');
            $table->string('Category_Type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Category_Type_Mst');
    }
};
