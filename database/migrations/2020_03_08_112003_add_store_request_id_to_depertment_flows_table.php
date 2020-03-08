<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStoreRequestIdToDepertmentFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('depertment_flows', function (Blueprint $table) {
            $table->unsignedBigInteger('store_request_id')->nullable()->after('depertment_id');
            $table->foreign('store_request_id')->references('id')->on('store_requests')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('depertment_flows', function (Blueprint $table) {
            $table->dropForeign(['store_request_id']);
        });
    }
}
