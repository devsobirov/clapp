<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('image')->nullable();
            $table->string('announcement')->nullable();
            $table->text('instruction')->nullable();
            $table->text('addinitional')->nullable();

            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->nullOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
