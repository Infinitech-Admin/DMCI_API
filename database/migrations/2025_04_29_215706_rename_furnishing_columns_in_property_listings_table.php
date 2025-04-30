<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('property_listings', function (Blueprint $table) {
            $table->renameColumn('furnishing_status', 'property_furnishing_status');
            $table->renameColumn('furnishing_items', 'property_furnishing_items');
        });
    }

    public function down(): void
    {
        Schema::table('property_listings', function (Blueprint $table) {
            $table->renameColumn('property_furnishing_status', 'furnishing_status');
            $table->renameColumn('property_furnishing_items', 'furnishing_items');
        });
    }
};
