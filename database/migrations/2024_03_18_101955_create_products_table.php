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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('category_id')->unsigned()->nullable();
            $table->string('sku')->nullable();
            $table->integer('pechnik_id')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('main')->default(0);
            $table->boolean('hit')->default(0);
            $table->boolean('new')->default(0);
            $table->boolean('stock')->default(0);
            $table->boolean('advice')->default(0);
            $table->integer('sort')->unsigned()->default(500);
            $table->string('h1')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('summary')->nullable();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2, true)->default(0);
            $table->json('properties')->nullable();
            $table->json('video')->nullable();
            $table->string('source')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
