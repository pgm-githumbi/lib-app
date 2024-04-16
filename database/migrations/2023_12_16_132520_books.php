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
        if(!Schema::hasTable("books")){
            Schema::create("books", function (Blueprint $table) {
                $table->bigIncrements("id");
                $table->string("name", 200);
                $table->string("publisher", 50);
                $table->string("isbn",50);
                //$table->foreign("subcategory")->references("id")->on("book_subcategory")->nullOnDelete()->noActionOnUpdate()->nullable();
                $table->text("description")->nullable();
                $table->integer("pages")->nullable();
                $table->string('image', 500)->nullable();
                $table->unsignedBigInteger('added_by')->nullable();
                $table->foreign("added_by")->references('id')->on('users')->nullOnDelete()->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
