<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('user_id');
            $table->string('name')->default('');
            $table->string('note')->nullable();
            $table->string('status')->default('draft');

            $table->timestamp('start_time')->nullable();
            $table->timestamp('total_time')->nullable();

            $table->integer('emails_total_count')->default(0);
            $table->integer('email_processed_count')->default(0);

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
        Schema::dropIfExists('campaigns');
    }
}
