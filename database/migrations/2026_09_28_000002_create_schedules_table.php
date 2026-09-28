<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('available_date');
            $table->time('available_time');
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            $table->unique(['available_date', 'available_time']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};