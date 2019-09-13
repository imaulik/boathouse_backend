<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVesselUserDepositsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessel_user_deposits', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('vessel_id');
            $table->string('deposit_amount');
            $table->boolean('check_broker');
            $table->string('broker_name')->nullable();
            $table->string('brokerage_name')->nullable();
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
        Schema::dropIfExists('vessel_user_deposits');
    }

}
