<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filters', function(Blueprint $table) {
            $table->increments('id');
            $table->string('sl_gender');
            $table->integer('sl_min_price');
            $table->integer('sl_max_price');
            $table->string('sl_color');
            $table->string('sl_occasion');
            $table->string('sl_style');
            $table->integer('wg_age')->unsigned();
            $table->integer('wg_min_price');
            $table->integer('wg_max_price');
            $table->date('wg_date_from');
            $table->date('wg_date_to');
            $table->integer('wg_city_id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::drop('filters');
    }
}
