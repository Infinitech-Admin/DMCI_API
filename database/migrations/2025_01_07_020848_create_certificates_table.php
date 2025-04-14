<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id');
            $table->string('title');
            $table->date('date'); 
            $table->text('description');
            $table->string('image');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
