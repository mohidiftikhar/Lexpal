<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductToLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('licenses', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->string('domain_name');
            $table->string('contract_id')->nullable();
            $table->string('client_name');
            $table->string('expiry_date');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('licenses', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
                $table->dropColumn('product_id');
                $table->dropColumn('domain_name');
                $table->dropColumn('contract_id');
                $table->dropColumn('client_name');
                $table->dropColumn('status');
        });
    }
}
