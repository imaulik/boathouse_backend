<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('select_masters', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('option_masters', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('select_id');
            $table->string('key_text');
            $table->string('value_text');
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


        Schema::dropIfExists('option_masters');
        Schema::dropIfExists('select_masters');
    }
}
