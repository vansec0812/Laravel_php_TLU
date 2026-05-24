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
        Schema::create('noitro', function (Blueprint $table) {
             $table->integerIncrements('NoiTroID');
            $table->string('Name');
            $table->enum('GioiTinh', ["Nam",'Nu']); 
            $table->string('Email');
            $table->unsignedInteger('ID');
            $table->foreign('ID')->references('ID')->on('noithat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noitro');
    }
};
