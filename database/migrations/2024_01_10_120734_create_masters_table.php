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
        Schema::create('masters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('title')->nullable();
            $table->integer('active')->unsigned()->default(1);
            $table->integer('sort')->unsigned()->default(50);
            $table->integer('main')->unsigned()->default(0);
            $table->unsignedBigInteger('master_id')->nullable();
            $table->foreign('master_id')->references('id')->on('masters');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('member')->unsigned()->default(1);
            $table->integer('whatsapp')->unsigned()->default(1);
            $table->string('participant')->nullable();
            $table->string('document')->nullable();
            $table->text('brief')->nullable();
            $table->string('h1')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masters');
    }
};
