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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            $table->string('product_code');
            $table->integer('product_cat')->length(100);
            $table->integer('product_sub_cat')->length(11);
            $table->integer('product_brand')->length(100);
            $table->string('product_title',255);
            $table->string('product_price',255);
            $table->string('product_desc');
            $table->string('featured_image');
            $table->integer('qty')->length(11);
            $table->string('product_keywords');
            $table->integer('product_views')->length(11);
            $table->integer('product_status')->length(11);
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
        Schema::dropIfExists('products');
    }
};
