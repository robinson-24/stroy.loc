<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        
        DB::table('users')->insert([
            'name'           => 'Admin',
            'email'          => 'admin@admin.net',
            'password'       => '$2y$10$GNMZQIvYjrauSd6mfLGRSucYTPSCUmAVzC1jbs2VQZO//PR/lgny.',
            'remember_token' => 'CWWlxqT3RAbNauGO4PeFcRVamMwJUDA00O73DSpHZwChGOvq6yhw3oTATTSv'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
