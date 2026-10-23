<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->text('ingredients');
            $table->text('steps');
            $table->unsignedSmallInteger('cook_time')->comment('Waktu memasak dalam menit');
            $table->string('image', 150);
            $table->string('category', 60)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
