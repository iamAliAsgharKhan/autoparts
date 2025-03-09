<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('years', function (Blueprint $table) {
            $table->id();
            $table->year('year')->unique(); // Ensure year values are unique
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('years');
    }
};