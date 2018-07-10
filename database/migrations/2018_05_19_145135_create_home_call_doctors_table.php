<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeCallDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_call_doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('second_name');
            $table->string('last_name');
            $table->string('address');
            $table->string('email');
            $table->text('description');
            $table->string('phone');
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
        Schema::dropIfExists('home_call_doctors');
    }
}
