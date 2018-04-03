<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullCalendarEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_calendar_events', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('title')->nullable();
            $table->datetime('start');
            $table->datetime('end')->nullable();
            //$table->boolean('allday')->nullable();
            $table->string('color', 7)->nullable();
            
            //$table->integer('user_id')->unsigned();
            //$table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('full_calendar_events');
    }
}
