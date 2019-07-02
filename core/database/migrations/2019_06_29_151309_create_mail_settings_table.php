<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_settings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('mail_id')->unsigned();

            $table->boolean('charset_randomize')->default(false);
            $table->boolean('dkim_signature')->default(false);
            $table->boolean('domain_key_signature')->default(false);
            $table->boolean('encoded_randomize')->default(false);
            $table->string('message_id_domain')->default('');
            $table->boolean('mixer')->default(false);
            $table->integer('random_lines')->default(0);
            $table->boolean('received')->default(false);
            $table->boolean('time_randomize')->default(false);
            $table->boolean('tz_randomize')->default(false);
            $table->integer('rotation_count')->default(0);
            $table->integer('rotation_mode')->default(0);

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
        Schema::dropIfExists('mail_settings');
    }
}
