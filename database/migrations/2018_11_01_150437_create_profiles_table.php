<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('avatar')->default('default-avatar.jpg');
            $table->string('birthday')->nullable();
            $table->string('location')->nullable();
            $table->string('occupation')->nullable();
            $table->string('website')->nullable();
            $table->text('bio')->nullable();
            $table->integer('energy')->default('48');
            $table->integer('health')->default('100');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
