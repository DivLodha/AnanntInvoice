<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDubaiCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dubai_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fk_customer_id')->unsigned();
            $table->string('course_name')->nullable();
            $table->integer('course_sort_order')->nullable();
            $table->double('course_fee', 8, 2)->nullable();
            
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
        Schema::dropIfExists('dubai_courses');
    }
}
