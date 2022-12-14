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
            $table->string('password')->nullable();
            $table->string('avatar')->default('https://www.sogapar.info/wp-content/uploads/2015/12/default-user-image.png');
            
            $table->integer('profile_id')->unsigned()->default(3);
            $table->foreign('profile_id')->references('id')->on('profiles');

            $table->integer('selected_project_id')->unsigned();
            $table->foreign('selected_project_id')->references('id')->on('projects');

            //$table->smallInteger('role')->default(2); // 0: Admin | 1: Support | 2: Client

            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}
