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
        Schema::create('supervisorapply', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('superviseeID');
            $table->bigInteger('supervisorID');
            $table->string('proposedTitle');
            $table->string('problemStatement');
            $table->string('domain');
            $table->string('declaration');
            $table->date('dateAgree')->nullable();
            $table->string('statusApplied');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisorapply');
    }
};
