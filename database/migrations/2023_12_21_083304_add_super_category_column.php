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
        if (!Schema::hasTable("book_categories")){
            Schema::table("book_categories", function(Blueprint $table){
                $table->unsignedBigInteger("super_category")
                ->nullable();
                $table->foreign("book_categories")
                ->references("id")->on("book_categories")
                ->onDelete("set null");
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("book_categories", function(Blueprint $table){
            if(Schema::hasColumn("book_categories", "super_category")){
                
                $table->dropForeign(['super_category']);
                $table->dropColumn('super_category');
            }
        });
    }
};
