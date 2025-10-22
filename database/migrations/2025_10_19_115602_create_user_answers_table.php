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
        Schema::create('user_answers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // user who answered
            $table->unsignedBigInteger('exam_id'); // exam reference
            $table->unsignedBigInteger('question_id'); // question reference
            $table->unsignedBigInteger('department_id')->nullable(); // optional: department

            $table->string('selected_answer'); // user selected option
            $table->string('correct_answer'); // correct answer from question

            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('new_questions')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_answers');
    }
};
