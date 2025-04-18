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
            $table->date('trans_date');
            $table->bigInteger('account_id');
            $table->bigInteger('chart_id');
            $table->string('type',10);
            $table->string('dr_cr',2);
            $table->decimal('amount',10,2);
            $table->bigInteger('payer_payee_id')->nullable();
            $table->bigInteger('invoice_id')->nullable();
            $table->bigInteger('purchase_id')->nullable();
            $table->bigInteger('purchase_return_id')->nullable();
            $table->bigInteger('payment_method_id');
            $table->string('reference',50)->nullable();
            $table->text('attachment')->nullable();
            $table->text('note')->nullable();
            $table->bigInteger('company_id');
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
