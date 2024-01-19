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
        if (!Schema::hasTable("book_subcategory")) {
            Schema::create("book_subcategory", function (Blueprint $table) {
                $table->bigIncrements("id");
                $table->string("subcategory_name", 150);
                $table->foreignId("category")->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("book_subcategory");
    }
};
