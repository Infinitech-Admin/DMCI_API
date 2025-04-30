<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('property_listings', function (Blueprint $table) {
            $table->string('furnishing_status')->nullable()->after('property_plan_image');
            $table->json('furnishing_items')->nullable()->after('furnishing_status');
        });
    }

    public function down(): void
    {
        Schema::table('property_listings', function (Blueprint $table) {
            $table->dropColumn(['furnishing_status', 'furnishing_items']);
        });
    }
};
