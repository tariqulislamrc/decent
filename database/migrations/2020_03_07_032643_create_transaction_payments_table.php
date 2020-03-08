<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_id')->nullable();
            $table->string('method')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('transaction_no')->nullable();
            $table->string('amount')->nullable();
            $table->string('note')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('transaction_payments');
    }
}
