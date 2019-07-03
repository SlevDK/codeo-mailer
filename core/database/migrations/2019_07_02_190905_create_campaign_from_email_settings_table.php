<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignFromEmailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_from_email_settings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('campaign_id')->unsigned();
            $table->integer('limit')->default(0);
            $table->integer('limit_interval')->default(0);
            $table->integer('mode')->default(0);
            $table->integer('pause_time')->default(0);
            $table->integer('ssl_limit')->default(0);
            $table->integer('thread_limit')->default(0);

            $table->timestamps();

            $table->foreign('campaign_id')
                ->references('id')
                ->on('campaigns')
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
        Schema::dropIfExists('campaign_from_email_settings');
    }
}
