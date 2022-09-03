<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SliderLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('app_link_id');
            $table->foreign('app_link_id')->references('id')->on('app_links')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('slider_id');
            $table->foreign('slider_id')->references('id')->on('sliders')->onDelete('cascade');
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
        Schema::table('slider_links', function (Blueprint $table) {
            $table->dropForeign(['app_link_id']);
            $table->dropColumn('app_link_id');
            $table->dropForeign(['slider_id']);
            $table->dropColumn('slider_id');
        });
    }
}
