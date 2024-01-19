<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private $table_in_ques = "books";
    private $new_column = "available";
    private $after_column = "description";
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table($this->table_in_ques, function (Blueprint $table) {
            $table->integer($this->new_column)->default(0)->after($this->after_column);
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table($this->table_in_ques, function (Blueprint $table) {
            if (Schema::hasColumn($this->table_in_ques,$this->new_column)) {
                $table->dropColumn($this->new_column);
            }
        });
    }
};
