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
        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('admin_id');
            $table->string('admin_name', 50);
            $table->string('username', 50);
            $table->string('password', 255);
            $table->string('com_logo', 100);
            $table->string('com_name', 100);
            $table->string('phone', 15);
            $table->string('com_address', 255);
            $table->string('cur_formate', 10);
            $table->tinyInteger('admin_role');
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
        Schema::dropIfExists('admin');
    }
};
