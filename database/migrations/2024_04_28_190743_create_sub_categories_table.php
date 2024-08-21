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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->bigIncrements('sub_cat_id');
            $table->string('sub_cat_title',100);
            $table->integer('cat_parent')->length(11);
            $table->integer('cat_products')->length(11);
            $table->tinyInteger('show_in_header')->length(4);
            $table->tinyInteger('show_in_footer')->length(4);
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
        Schema::dropIfExists('sub_categories');
    }
};
