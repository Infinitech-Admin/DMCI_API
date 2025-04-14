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
        Schema::create('listings', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id');
            $table->foreignUlid('property_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('unit_type');
            $table->double('unit_price', 10, 2);
            $table->string('status');
            $table->string('description');
            $table->json('images');
            $table->string('furnish_status');
            $table->json('item');
            $table->string('unit_area');
            $table->foreignUlid('building_id');
            $table->string('unit_cut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
