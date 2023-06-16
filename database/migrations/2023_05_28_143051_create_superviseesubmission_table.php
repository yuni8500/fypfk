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
        Schema::create('superviseesubmission', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('submissionID');
            $table->bigInteger('superviseeID');
            $table->bigInteger('supervisorID')->nullable();
            $table->string('docSubmission');
            $table->string('marks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('superviseesubmission');
    }
};
