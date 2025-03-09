<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->text('note')->nullable();
            $table->enum('quality', ['new', 'used']);
            $table->integer('stock_level')->default(0);
            $table->string('main_image')->nullable();
            $table->string('image_1')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->foreignId('make_id')->nullable()->constrained('makes')->onDelete('set null');
            $table->foreignId('car_model_id')->nullable()->constrained('car_models')->onDelete('set null');
            $table->foreignId('year_id')->nullable()->constrained('years')->onDelete('set null');
                       
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null'); // Foreign key to categories
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
