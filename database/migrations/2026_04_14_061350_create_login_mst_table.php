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
        Schema::create('Login_Mst', function (Blueprint $table) {
            $table->id();
            $table->string('Ccode');
            $table->string('Lcode');
            $table->string('UserRole');
            $table->string('UserName');
            $table->string('Password');
            $table->string('IsActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Login_Mst');
    }
};
