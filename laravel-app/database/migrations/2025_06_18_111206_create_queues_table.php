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
    Schema::create('queues', function (Blueprint $table) {
        $table->id('queue_id');
        $table->string('queue_number');
        $table->unsignedBigInteger('patient_id');
        $table->unsignedBigInteger('clinic_id');
        $table->unsignedBigInteger('counter_id');
        $table->enum('phase', ['waiting', 'consultation', 'pharmacy', 'completed']);
        $table->enum('status', ['pending', 'active', 'done', 'cancelled', 'in_progress']);


        $table->timestamps();

        // Foreign keys
        $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        $table->foreign('clinic_id')->references('clinic_id')->on('clinics')->onDelete('cascade');
        $table->foreign('counter_id')->references('counter_id')->on('counters')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};
