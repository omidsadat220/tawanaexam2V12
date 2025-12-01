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
        Schema::create('voucher_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // voucher string
            $table->unsignedBigInteger('user_id')->nullable(); // student
            $table->unsignedBigInteger('category_id')->nullable(); // exam_id

            $table->boolean('is_used')->default(false); // one-time login
            $table->timestamp('expired_at')->nullable(); // optional
            $table->timestamps();
            // Relations
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_codes');
    }
};
