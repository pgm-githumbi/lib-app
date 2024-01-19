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
        // if(!Schema::hasTable("subcategory")){

        //     Schema::create('subcategory', function (Blueprint $table) {
        //         $table->id();
        //         $table->string('name');
        //         $table->unsignedBigInteger('category');
        //         $table->foreign('category')->references('id')
        //             ->on('categories')->cascadeOnDelete();
        //         $table->timestamps();
        //     });
        // }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //Schema::dropIfExists('subcategory');
    }
};
