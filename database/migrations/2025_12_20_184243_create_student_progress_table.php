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
        Schema::create('student_progress', function (Blueprint $table) {
            $table->id();

            $table->foreignId('meeting_id')
                ->constrained('meetings')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->text('progress_note')->nullable();

            $table->enum('status', [
                'hadir',
                'tidak_hadir',
                'paham',
                'belum_paham',
            ])->default('hadir');

            $table->timestamps();

            $table->unique(['meeting_id', 'student_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_progress');
    }
};
