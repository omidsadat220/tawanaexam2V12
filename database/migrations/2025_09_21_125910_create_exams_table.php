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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->string('exam_title');
            $table->time('start_time')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('department_id')
                ->references('id')->on('departments')
                ->onDelete('cascade');   

            $table->foreign('subject_id')
                ->references('id')->on('department_subjects')
                ->onDelete('set null');  
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
