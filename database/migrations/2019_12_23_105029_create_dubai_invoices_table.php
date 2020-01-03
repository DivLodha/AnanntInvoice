<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDubaiInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dubai_invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fk_customer_id')->unsigned();
            $table->string('invoice_no')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('payment_type')->nullable();
            $table->double('total_fee', 8, 2)->nullable();
            $table->double('discounted_fee', 8, 2)->nullable();
            $table->double('paid_amount', 8, 2)->nullable();
            $table->double('due_amount', 8, 2)->nullable();
            $table->date('due_date')->nullable();
            $table->string('discount')->nullable();
            $table->double('discount_amount')->nullable();
            $table->double('previous_paid')->nullable();
            $table->double('previous_due')->nullable();
            $table->double('previous_discount')->nullable();
            $table->double('previous_discounted_fee')->nullable();
            $table->text('courses_opted')->nullable();
            $table->text('note')->nullable();

            $table->foreign('fk_customer_id')->references('id')->on('dubai_customers')->onDelete('cascade');
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
        Schema::dropIfExists('dubai_invoices');
    }
}
