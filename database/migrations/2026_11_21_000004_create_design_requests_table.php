<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('design_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 40);
            $table->string('email');
            $table->string('location');
            $table->longText('room_description');
            $table->string('dimensions')->nullable();
            $table->string('style');
            $table->string('color');
            $table->string('budget')->nullable();
            $table->json('photo_paths')->nullable();
            $table->string('generated_image_path')->nullable();
            $table->string('status')->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('design_requests');
    }
};
