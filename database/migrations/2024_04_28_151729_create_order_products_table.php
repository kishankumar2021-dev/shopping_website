<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->bigIncrements('order_id');
            $table->string('product_id',100);
            $table->string('product_qty',100);
            $table->string('total_amount',10);
            $table->integer('product_user')->length(11);
            $table->string('order_date',11);
            $table->string('pay_req_id',100);
            $table->tinyInteger('confirm')->length(4);
            $table->tinyInteger('delivery')->length(4);
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
        Schema::dropIfExists('order_products');
    }
};
