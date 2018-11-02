<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->longText('text');
            $table->boolean('finished')->default(false);
            $table->timestamps();
            $table->integer('mins');
            $table->integer('energy_req')->nullable();
            $table->integer('description')->nullable();
            $table->date('due_date')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('priority')->default(false);
            $table->boolean('in_progress')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
