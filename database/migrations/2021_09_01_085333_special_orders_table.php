<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SpecialOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_no')->nullable();
            $table->string('name');
            $table->string('status');
            $table->dateTime('read_date')->nullable();
            $table->string('address')->nullable();
            $table->bigInteger('mobile');
            $table->string('delivery_branch');
            $table->date('delivery_date');
            $table->string('delivery_address');
            $table->time('delivery_time');
            $table->string('size');
            $table->string('count')->nullable();
            $table->text('details')->nullable();
            $table->bigInteger('price');
            $table->dateTime('date');
            $table->string('employee');
            $table->string('branch');
            $table->bigInteger('payment')->nullable();
            $table->bigInteger('remaining');
            $table->string('sugar');
            $table->string('classic');
            $table->string('special');
            $table->string('created_by');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_details');

    }
}
