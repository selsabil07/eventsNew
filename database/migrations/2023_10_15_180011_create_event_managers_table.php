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
        Schema::create('event_managers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->default(1); // Foreign key
            $table->foreign('admin_id')->references('id')->on('admins');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('password');
            $table->string('Cpassword');
            $table->boolean('approved')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_managers');
    }
};
