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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('priority_level')->default(2);
            $table->foreignId('dentist_id')->constrained('contacts')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('contacts')->onDelete('cascade');
            $table->foreignId('schedule_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('previous_appointment_id')->nullable()->constrained('appointments')->onDelete('set null');
            $table->string('consultation_hours')->nullable();
            $table->string('status')->default(1);
            $table->text('remarks')->nullable();
            $table->string('approval_status')->default(1);
            $table->boolean('is_walk_in')->default(false);
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
