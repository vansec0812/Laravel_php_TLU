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
        Schema::create('_docs', function (Blueprint $table) {
             $table->integerIncrements('Id_Doc');
            $table->string('Name_Doc');
            $table->string('Author');
            $table->string('Des');

            $table->unsignedInteger('Id_DocType');
            $table->foreign('Id_DocType')->references('Id_DocType')->on('_doc_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_docs');
    }
};
