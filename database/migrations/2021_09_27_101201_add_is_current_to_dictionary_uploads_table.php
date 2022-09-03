<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsCurrentToDictionaryUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dictionary_uploads', function (Blueprint $table) {
            $table->boolean('is_current')->default(0)->after('json_file');
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
            $table->dropColumn('is_current');
        });
    }
}
