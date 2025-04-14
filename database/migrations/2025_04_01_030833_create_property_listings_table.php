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
        Schema::create('property_listings', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id');
            $table->foreignUlid('property_id');
            $table->string('property_location');
            $table->string('property_type');
            $table->double('property_size', 15, 2);
            $table->double('property_price', 15, 2);
            $table->string('property_building');
            $table->string('property_parking');
            $table->text('property_description');
            $table->string('property_level');
            $table->boolean('property_featured');
            $table->json('property_amenities');
            $table->json('images');
            $table->string('property_plan_type');
            $table->string('property_plan_cut');
            $table->string('property_plan_status');
            $table->string('property_plan_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_listings');
    }
};
