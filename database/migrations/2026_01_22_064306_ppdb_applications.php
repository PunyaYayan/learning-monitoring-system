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
        Schema::create('ppdb_applications', function (Blueprint $table) {
            $table->id();

            // DATA SISWA
            $table->string('fullname');
            $table->date('birthdate')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();

            $table->string('school')->nullable();
            $table->string('student_email')->nullable();

            $table->text('address')->nullable();
            $table->string('phone'); // HP siswa / pendaftar

            // DATA WALI / ORTU
            $table->string('parent_name')->nullable();
            $table->string('parent_phone')->nullable();
            $table->string('parent_email')->nullable();

            // TIPE PENDAFTAR
            $table->enum('applicant_type', ['student', 'college_student', 'worker']);

            // STATUS
            $table->enum('status', [
                'submitted',
                'approved',
                'rejected',
            ])->default('submitted');

            // VALIDASI
            $table->timestamp('validated_at')->nullable();

            $table->foreignId('validated_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // CATATAN ADMIN
            $table->text('admin_note')->nullable();

            $table->timestamps();
        });
    }



    public function down(): void
    {
        Schema::dropIfExists('ppdb_applications');
    }
};
