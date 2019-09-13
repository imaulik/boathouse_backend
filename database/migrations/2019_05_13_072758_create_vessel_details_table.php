<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVesselDetailsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessel_details', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->longText('description')->nullable();
            $table->string('feature_image')->nullable();
            $table->string('location')->nullable();
            $table->string('year')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('loa')->nullable();
            $table->string('beam')->nullable();
            $table->string('draft')->nullable();
            $table->string('co_brokerage')->nullable();
            $table->string('broker_name')->nullable();
            $table->string('broker_email')->nullable();
            $table->text('broker_logo')->nullable();
            $table->string('preview_period')->nullable();
            $table->string('haul_out')->nullable();
            $table->string('sea_trial')->nullable();
            $table->boolean('auction_feature')->nullable();
            $table->string('auction_address')->nullable();
            $table->string('auction_start_price')->nullable();
            $table->string('auction_reserve_price')->nullable();
            $table->string('auction_buy_now_price')->nullable();
            $table->string('auction_quantity')->nullable();
            $table->datetime('auction_begins')->nullable();
            $table->datetime('auction_ends')->nullable();
            $table->string('incremental_bid')->nullable();
            $table->string('deposit_amount')->nullable();
            $table->string('buyer_document_agreement')->nullable();
            $table->boolean('allowed_comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vessel_details');
    }

}
