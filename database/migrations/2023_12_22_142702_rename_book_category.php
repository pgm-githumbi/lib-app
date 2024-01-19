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
        $oldTableName = "book_category";
        $newTableName = "categories";

        Schema::dropIfExists($newTableName);

        if(Schema::hasTable($oldTableName)) {
            Schema::rename($oldTableName, $newTableName);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $oldTableName = "categories";
        $newTableName = "book_category";

        Schema::dropIfExists($newTableName);

        if(Schema::hasTable($oldTableName)) {
            Schema::rename($oldTableName, $newTableName);
        }
    }
};
