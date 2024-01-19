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
        if(!Schema::hasColumn("books","category")){

            Schema::table('books', function (Blueprint $table) {
                $table->unsignedBigInteger('category');
                $table->foreign('category')->references('id')->on('categories')->restrictOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if(Schema::hasColumn('books','category')){
                $table->dropColumn('category');
                $table->dropForeign(['category']);
            }
        });
    }
};
