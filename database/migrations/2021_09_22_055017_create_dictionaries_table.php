<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dictionaries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('language_id')->default(0);
            $table->text('ids')->nullable();
            $table->text('entryword')->nullable();
            $table->text('inflactedform')->nullable();
            $table->text('topic')->nullable();
            $table->text('pos')->nullable();
            $table->text('pos_1')->nullable();
            $table->text('entryword_1')->nullable();
            $table->text('inflactedform_1')->nullable();
            $table->text('dn_type')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dictionaries');
    }
}
