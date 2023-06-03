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
        Schema::create('fyplibrary', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('submissionID');
            $table->bigInteger('superviseeID');
            $table->string('projectTitle');
            $table->string('abstract');
            $table->string('fileProject');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fyplibrary');
    }
};
