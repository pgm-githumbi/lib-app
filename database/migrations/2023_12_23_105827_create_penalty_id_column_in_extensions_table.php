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
        if(!Schema::hasColumn("extensions","penalty_id")){
            Schema::table('extensions', function (Blueprint $table) {
                $table->unsignedBigInteger('penalty_id');
                $table->foreign('penalty_id')->references('id')->on('penalties')->cascadeOnDelete();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if(Schema::hasColumn('extensions','penalty_id')){
            Schema::dropColumns('extensions', 'penalty_id');
        }
    }
};
