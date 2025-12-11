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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('final_result_id');
            $table->string('name');          
            $table->string('lastname');      
            $table->date('date');
            $table->string('pdf');
            $table->text('description');
            $table->timestamps();

            $table->foreign('final_result_id')->references('id')->on('final_exam_results')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
