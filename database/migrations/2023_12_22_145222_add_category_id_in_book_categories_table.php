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
        Schema::table('book_categories', function (Blueprint $table) {
            if(!Schema::hasColumn('book_categories','category_id')){
                $table->unsignedBigInteger('category_id')->nullable();
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('book_categories', function (Blueprint $table) {
            if(Schema::hasColumn('book_categories','category_id')){
                $table->dropColumn('category_id');
                $table->dropForeign('category_id');
            }
        });
    }
};
