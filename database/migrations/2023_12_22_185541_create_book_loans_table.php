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
        if (!Schema::hasTable('book_loans')){
            Schema::create('book_loans', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('book_id');
                $table->enum('loan_status', ['unpaid', 'piad']);
                $table->date('loan_date')->default(now());
                $table->date('due_date');
                $table->date('return_date');
                $table->unsignedBigInteger('added_by')->nullable();
                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('added_by')->references('id')->on('users');
                $table->foreign('book_id')->references('id')->on('books');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_loans');
    }
};
