<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherDictionaryUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dictionary_uploads', function (Blueprint $table) {
            $table->integer('page')->default(1);
            $table->integer('total_page')->default(0);
            $table->string('is_json_completed')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dictionary_uploads', function (Blueprint $table) {
            $table->dropColumn(['page','total_page','is_json_completed']);
        });
    }
}
