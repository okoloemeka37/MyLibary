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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('link'); 
            $table->text('description'); 
            $table->string("price");
            $table->foreignId('user_id')->contrained()->onDelete('cascade');
            $table->string("location");     
            $table->string("author");
            $table->string("image");
            $table->string("genre");
            $table->string("ISBN");
            $table->string("page");
            $table->string("language");
            $table->string("free");
            $table->string("hard_copy");
            $table->integer('num_download');
            $table->integer("num_comments");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
            Schema::dropIfExists('books');
    }
};
