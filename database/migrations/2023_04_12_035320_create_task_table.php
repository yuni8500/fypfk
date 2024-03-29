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
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('superviseeID');
            $table->string('titleTask');
            $table->string('assignor');
            $table->date('dueDate');
            $table->string('priority');
            $table->string('status');
            $table->string('taskDetails');
            $table->string('progress');
            $table->string('attachment')->nullable();
            $table->string('comment')->nullable();
            $table->string('supervisorAttachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};
