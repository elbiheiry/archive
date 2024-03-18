<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ar_name');
            $table->string('en_name');
            $table->string('job');
            $table->string('institute');
            $table->string('phone');
            $table->string('mobile');
            $table->string('postal');
            $table->string('city');
            $table->string('country');
            $table->string('address');
            $table->string('email');
            $table->string('website')->nullable();
            $table->text('notes')->nullable();
            $table->string('image');
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
        Schema::dropIfExists('cards');
    }
}
