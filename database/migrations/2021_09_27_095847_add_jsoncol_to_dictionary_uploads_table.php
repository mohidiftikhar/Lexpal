<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJsoncolToDictionaryUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dictionary_uploads', function (Blueprint $table) {
            $table->text('json_file')->nullable()->after('versions');
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
            $table->dropColumn('json_file');
        });
    }
}
