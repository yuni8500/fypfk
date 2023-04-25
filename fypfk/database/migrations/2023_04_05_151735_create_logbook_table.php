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
        Schema::create('logbook', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('superviseeID');
            $table->bigInteger('supervisorID');
            $table->bigInteger('weekLog');
            $table->date('dateLog');
            $table->time('timeStart');
            $table->time('timeEnd');
            $table->string('progress');
            $table->string('comment')->nullable();
            $table->string('approval');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbook');
    }
};
