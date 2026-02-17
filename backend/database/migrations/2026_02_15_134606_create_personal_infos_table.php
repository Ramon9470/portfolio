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
        Schema::create('personal_infos', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('title'); 
            $table->text('summary'); 
            $table->string('email');
            $table->string('phone')->nullable();
            
            $table->string('profile_photo_url')->nullable(); 
            $table->string('cv_url')->nullable(); 
            
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('whatsapp_url')->nullable();
            $table->string('instagram_url')->nullable();
            
            $table->string('city')->nullable();
            $table->string('state')->nullable();

            $table->json('skills')->nullable();
            $table->json('languages')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_infos');
    }
};
