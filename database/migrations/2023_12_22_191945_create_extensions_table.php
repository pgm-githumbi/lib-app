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
        if(!Schema::hasTable("extensions")){
            Schema::create('extensions', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('loan_id');
                $table->date('extension_date')->default(now());
                $table->date('expected_return_date');
                $table->timestamps();
                $table->foreign('loan_id')->references('id')
                ->on('book_loans')->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extensions');
    }
};
