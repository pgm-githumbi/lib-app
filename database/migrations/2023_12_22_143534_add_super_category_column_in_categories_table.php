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
        Schema::table('categories', function (Blueprint $table) {
            $column = 'super_category';
            if(!Schema::hasColumn('categories', $column)) {
                $table->unsignedBigInteger('super_category')->nullable()
                    ->default(0);
                $table->foreign($column)->references('id')
                    ->on('categories')->cascadeOnDelete();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $column = 'super_category';
            if(!Schema::hasColumn('categories',$column)) {
                Schema::dropColumns('categories', [$column]);
                $table->dropForeign([$column]);
            }
        });
    }
};
