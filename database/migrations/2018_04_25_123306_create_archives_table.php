<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_number');
            $table->integer('group_id');
            $table->string('file_path');
            $table->integer('category_id');
            $table->string('how_to_send');
            $table->text('subject');
            $table->string('from_to');
            $table->string('incharge');
            $table->string('file_status');
            $table->string('report');
            $table->text('notes');
            $table->timestamp('register_date');
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
        Schema::dropIfExists('archives');
    }
}
