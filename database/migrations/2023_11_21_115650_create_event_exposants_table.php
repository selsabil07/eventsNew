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
        
        Schema::create('event_exposant', function (Blueprint $table) {
            $table->id();
        
            // Define foreign key constraints
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        
            $table->unsignedBigInteger('exposant_id');
            $table->foreign('exposant_id')->references('id')->on('exposants')->onDelete('cascade');
        
            $table->timestamps();
        });
        
    }

    
    public function down(): void
    {
        Schema::dropIfExists('event_exposant');
    }
};
