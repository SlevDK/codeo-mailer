<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignRandomizerSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_randomizer_settings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('campaign_id')->unsigned();
            $table->boolean('add_no_display_blocks')->default(false);
            $table->boolean('add_random_class_name')->default(false);
            $table->integer('color_difference')->default(0);
            $table->boolean('edit_color')->default(false);
            $table->boolean('edit_font_family')->default(false);
            $table->boolean('edit_font_size')->default(false);
            $table->boolean('edit_text')->default(false);
            $table->integer('edit_text_chance')->default(0);
            $table->boolean('enabled')->default(true);
            $table->integer('font_size_difference')->default(0);
            $table->integer('no_display_block_text_difference')->default(0);
            $table->integer('no_display_blocks_difference')->default(0);
            $table->integer('random_class_chance')->default(0);
            $table->integer('random_class_name_length')->default(0);

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
        Schema::dropIfExists('campaign_randomizer_settings');
    }
}
