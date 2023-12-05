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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('EventManager_id')->default(1); // Foreign key
            $table->foreign('EventManager_id')->references('id')->on('event_managers');
            $table->string('eventTitle');
            $table->string('organization'); 
            $table->string('country');
            $table->string('tags');
            $table->string('sector');
            $table->binary('photo')->nullable();
            $table->string('summary');
            $table->string('description'); 
            $table->boolean('approved')->default(0);
            $table->date('startingDate');
            $table->date('endingDate');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};    