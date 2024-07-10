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
        Schema::create('alhalaqats', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("descrption")->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            // $table->foreignId('subdivision_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alhalaqats');
    }
};
