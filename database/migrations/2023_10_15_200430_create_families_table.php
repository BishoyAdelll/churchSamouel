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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('father_image')->nullable();
            $table->string('mother_image')->nullable();
            $table->boolean('status')->default(0);
            $table->foreignId('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreignId('church_id')->references('id')->on('churches')->onDelete('cascade');
            $table->foreignId('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreignId('street_id')->references('id')->on('streets')->onDelete('cascade');
            $table->foreignId('address_id')->references('id')->on('addresses')->onDelete('cascade');
            $table->text('address')->nullable();
            $table->string('first_phone')->nullable();
            $table->string('second_phone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('families');
    }
};
