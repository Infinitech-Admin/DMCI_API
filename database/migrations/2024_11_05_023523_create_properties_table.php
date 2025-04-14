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
        Schema::create('properties', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id');
            $table->string('name');
            $table->string('slogan');
            $table->string('location');
            $table->double('min_price', 10, 2);
            $table->double('max_price', 10, 2);
            $table->string('status');
            $table->double('percent', 10, 2);
            $table->text('description');
            $table->string('logo');
            $table->boolean('featured');
            $table->json('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
