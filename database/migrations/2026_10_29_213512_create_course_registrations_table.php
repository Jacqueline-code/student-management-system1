<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('course_registrations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                  ->constrained('students')
                  ->cascadeOnDelete();

            $table->foreignId('course_id')
                  ->constrained('courses')
                  ->cascadeOnDelete();

            $table->string('academic_year');
            $table->string('semester');
            $table->string('status')->default('registered');

            $table->timestamps();

            $table->unique(
                ['student_id', 'course_id', 'academic_year', 'semester'],
                'student_course_term_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('course_registrations');
    }
};