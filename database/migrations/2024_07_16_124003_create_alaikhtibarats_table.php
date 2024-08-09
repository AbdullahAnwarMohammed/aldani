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
        Schema::create('alaikhtibarats', function (Blueprint $table) {
            $table->id();
            // $table->integer("type")->comment('نوع الامتحان الاول او الثاني او ');
            $table->integer("test1")->nullable();
            $table->integer("test2")->nullable();
            $table->integer("test3")->nullable();
            $table->integer("test4")->nullable();
            $table->integer("degree")->comment('الدرجة');
            $table->foreignId('talib_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('session_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alaikhtibarats');
    }
};
