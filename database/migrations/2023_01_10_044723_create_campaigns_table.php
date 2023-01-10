<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('campaign_title');
            $table->string('campaign_start_date')->nullable();
            $table->string('campaign_end_date')->nullable();
            $table->string('campaign_image')->nullable();
            $table->integer('campaign_status')->nullable();
            $table->integer('campaign_discount')->nullable();
            $table->string('campaign_month')->nullable();
            $table->string('campaign_year')->nullable();
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
