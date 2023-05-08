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
        Schema::create('appointment', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('superviseeID');
            $table->bigInteger('supervisorID');
            $table->string('appointTitle');
            $table->date('appointDate');
            $table->time('startTime');
            $table->time('endTime');
            $table->string('purpose');
            $table->string('statusAppoint');
            $table->string('appointLocation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};
