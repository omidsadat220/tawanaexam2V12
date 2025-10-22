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
        Schema::create('new_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('question');
            $table->string('image')->nullable();
            $table->string('option1');
            $table->string('option2');
            $table->string('option3');
            $table->string('option4');
            $table->string('correct_answer');
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
        Schema::dropIfExists('new_questions');
    }
};
