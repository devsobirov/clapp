<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('food_fields', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('food_id');
            $table->unsignedBigInteger('field_id');
            $table->text('value')->nullable();
            $table->integer('order')->nullable();
            $table->unique(['field_id', 'food_id']);

            $table->foreign('food_id')->references('id')->on('food')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('field_id')->references('id')->on('fields')
                ->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('food_fields');
    }
};
