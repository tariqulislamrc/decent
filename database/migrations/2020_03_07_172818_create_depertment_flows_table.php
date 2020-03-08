<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepertmentFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depertment_flows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('depertment_id')->nullable();
            $table->integer('send_depertment_id')->nullable();
            $table->unsignedBigInteger('work_order_id')->nullable();
            $table->unsignedBigInteger('raw_material_id')->nullable();
            $table->string('use_qty')->nullable();
            $table->string('waste_qty')->nullable();
            $table->string('date')->nullable();
            $table->string('status')->nullable();
            $table->text('note')->nullable();
            $table->boolean('hidden')->default(0);
            $table->longText('tek_marks')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->foreign('depertment_id')->references('id')->on('depertments')->onDelete('cascade');
            $table->foreign('work_order_id')->references('id')->on('work_orders')->onDelete('cascade');
            $table->foreign('raw_material_id')->references('id')->on('raw_materials')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depertment_flows');
    }
}
