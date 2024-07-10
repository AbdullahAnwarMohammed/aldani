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
        Schema::create('talibs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alhalaqat_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('almustawayat_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('country_id')->constrained()->cascadeOnDelete();
            $table->foreignId('aldafeuh_id')->constrained()->cascadeOnDelete();
            $table->string("name");
            $table->boolean("gender");
            $table->date("date_of_birth")->nullable();
            $table->string("phone",50)->nullable();
            $table->string("father_phone",50)->nullable();
            $table->string("cid",100);
            $table->boolean('subscrption')->default(0);
            $table->string('photo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talibs');
    }
};
