<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->string('school')->nullable();
            $table->string('city')->nullable();
            $table->double('total_fee', 8, 2)->nullable();
            $table->double('discounted_fee', 8, 2)->nullable();
            $table->double('paid_amount', 8, 2)->nullable();
            $table->double('due_amount', 8, 2)->nullable();
            $table->string('discount')->nullable();
            $table->string('discount_amount')->nullable();
            
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
        Schema::dropIfExists('customers');
    }
}
