<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsvSpiltsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csv_parts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('upload_id')->default(0);
            $table->string('csv_path')->nullable();
            $table->bigInteger('page')->default(1);
            $table->bigInteger('import_records')->default(0);
            $table->bigInteger('total_records')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csv_parts');
    }
}
