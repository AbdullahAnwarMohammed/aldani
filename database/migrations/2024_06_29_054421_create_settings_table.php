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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("name_site");
            $table->string("logo_small")->nullable();
            $table->string("logo_big")->nullable();
            $table->string("favicon_site")->nullable();
            $table->string("email_site")->nullable();
            $table->string("phone",30)->nullable();
            $table->boolean("status_site")->default(1);
            $table->boolean("login_almuhfazin")->default(1);
            $table->string("facebook_site")->nullable();
            $table->string("twitter_site")->nullable();
            $table->string("youtube_site")->nullable();
            $table->string("instgram_site")->nullable();
            $table->string("address")->nullable();
            $table->string("maps")->nullable();
            $table->string("message_close_site")->nullable();
            $table->integer("year")->default(date("Y"));    
                    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
