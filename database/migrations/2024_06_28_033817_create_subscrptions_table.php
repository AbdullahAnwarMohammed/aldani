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
        Schema::create('subscrptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talib_id')->constrained()->cascadeOnDelete();
            $table->date("reg_start");
            $table->date("reg_end");
            $table->integer("required_value");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscrptions');
    }
};
