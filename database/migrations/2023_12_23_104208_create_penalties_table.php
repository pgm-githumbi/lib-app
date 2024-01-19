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
        if(!Schema::hasTable('penalties')){
            Schema::create('penalties', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('book_loan_id');
                $table->unsignedFloat('penalty_amount_ksh');
                $table->unsignedFloat('penalty_amount_paid_ksh');
                $table->timestamps();
                $table->foreign('book_loan_id')->references('id')->on('book_loans');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penalties');
    }
};
