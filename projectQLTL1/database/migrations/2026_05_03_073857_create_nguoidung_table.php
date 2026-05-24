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
        Schema::create('nguoidung', function (Blueprint $table) {
            $table->integerIncrements('NguoiDungID');
            $table->string('TenNguoiDung');
            $table->enum('GioiTinh', ["Nam",'Nu']);
            $table->string('DiaChi');
            $table->string('DienThoai');
            $table->string('Email');
            $table->unsignedInteger('ID');
            $table->foreign('ID')->references('ID')->on('tailieu1')->onDelete('cascade');
        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nguoidung');
    }
};
