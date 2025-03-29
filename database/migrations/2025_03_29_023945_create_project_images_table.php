<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('project_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')
                  ->constrained('projects') // Links to the 'id' on the 'projects' table
                  ->onDelete('cascade'); // If a project is deleted, delete its images too
            $table->string('image_path'); // Path relative to storage/app/public
            $table->enum('type', ['before', 'after']); // Type of image
            $table->integer('order')->default(0); // For display order if needed
            $table->timestamps();

            // Optional index for faster lookups
            $table->index(['project_id', 'type', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_images');
    }
};