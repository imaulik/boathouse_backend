<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVesselDetailColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('vessel_details', function($table) {
            $table->string('bidders_agreement')->nullable();
            $table->string('opening_bid_incentive')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('vessel_details', function($table) {
            $table->dropColumn('bidders_agreement');
            $table->dropColumn('opening_bid_incentive');
        });
    }
}
