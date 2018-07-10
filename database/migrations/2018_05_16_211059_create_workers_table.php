<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('second_name');
            $table->string('last_name');
            $table->string('passport_id');
            $table->text('description');
            $table->integer('user_id')->foreign('user_id')->references('id')->on('users');
            $table->integer('department_id')->foreign('department_id')->references('id')->on('departments');
            $table->integer('position_id')->foreign('position_id')->references('id')->on('position_helds');
            $table->integer('specialization_id')->foreign('specialization_id')->references('id')->on('specializations');
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
        Schema::dropIfExists('workers');
    }
}
