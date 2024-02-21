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
        Schema::create('notifications',function(Blueprint $table){
                    $table->id();
                    $table->string('from_id');
                    $table->foreignId('user_id')->contrained()->onDelete('cascade');
                    $table->foreignId('item_id')->contrained()->onDelete('cascade');
                    $table->string('description');
                    $table->string("status");
                    $table->string('type');
                    $table->string('for_text');
                    $table->string('item_title');
                    
                    $table->timestamps();
                   

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notification');
    }
};
