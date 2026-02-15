<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('class_id')->constrained('classes')->cascadeOnDelete();
            $table->foreignId('report_period_id')->constrained()->cascadeOnDelete();

            $table->Integer('listening_score')->nullable();
            $table->Integer('speaking_score')->nullable();
            $table->Integer('reading_score')->nullable();
            $table->Integer('writing_score')->nullable();
            $table->Integer('final_score')->nullable();

            $table->text('teacher_note')->nullable();
            $table->boolean('is_locked')->default(false);
            $table->timestamps();

            $table->unique(['student_id', 'report_period_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
