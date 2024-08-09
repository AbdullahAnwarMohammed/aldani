<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasmies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('talib_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger("attend");
            $table->foreignId('part_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('alhalaqat_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('session_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('almanhaj_id')->nullable()->constrained()->nullOnDelete();
            $table->tinyInteger("number_of_quarters");
            $table->string("degree",100);
            $table->string("comment")->nullable();

            $table->datetime('date')->default(DB::raw('CURRENT_DATE'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasmies');
    }
};
