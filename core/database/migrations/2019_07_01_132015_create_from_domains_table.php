<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFromDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('from_domains', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('mail_id')->unsigned();
            $table->json('data');

            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->foreign('mail_id')
                ->references('id')
                ->on('mails')
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
        Schema::dropIfExists('from_domains');
    }
}
