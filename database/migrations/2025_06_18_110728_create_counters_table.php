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
        Schema::create('counters', function (Blueprint $table) {
            $table->id('counter_id');
            $table->string('counter_name');
            $table->string('status'); // e.g., 'open', 'closed'
            $table->unsignedBigInteger('clinic_id');
            $table->timestamps();

            $table->foreign('clinic_id')->references('clinic_id')->on('clinics')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counters');
    }
};
