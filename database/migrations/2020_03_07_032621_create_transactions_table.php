<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('purchase_by')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('date')->nullable();
            $table->string('type')->nullable();
            $table->string('work_order_id')->nullable();
            $table->string('status')->nullable();
            $table->string('sub_total')->nullable();
            $table->string('discount')->nullable();
            $table->string('discount_type')->nullable();
            $table->string('discount_amount')->nullable();
            $table->string('net_total')->nullable();
            $table->string('paid')->nullable();
            $table->string('due')->nullable();
            $table->string('payment_status')->nullable();
            $table->longText('stuff_note')->nullable();
            $table->longText('sell_note')->nullable();
            $table->longText('transaction_note')->nullable();
            $table->boolean('hidden')->default(0);
            $table->longText('tek_marks')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
