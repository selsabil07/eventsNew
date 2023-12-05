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
        Schema::create('admins', function (Blueprint $table) {
                $table->id();
                $table->string('AdminName');
                $table->string('password');    
                $table->string('api_token', 80)->unique()->nullable()->default(null);
                $table->rememberToken();
                $table->timestamps();
           
        });
        DB::table('admins')->insert([
            'AdminName' => 'admin',
            'password' => Hash::make('12345'),
        ]);

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
