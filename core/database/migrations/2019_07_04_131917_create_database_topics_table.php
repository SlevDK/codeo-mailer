<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabaseTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_topics', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->json('data');

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('database_topics');
    }
}
