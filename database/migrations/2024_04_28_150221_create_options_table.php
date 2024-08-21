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
        Schema::create('options', function (Blueprint $table) {
            $table->integer('s_no')->lenght(20);
            $table->string('site_name',100);
            $table->string('site_title',100);
            $table->string('site_logo',100);
            $table->string('site_desc',255);
            $table->string('footer_text',100);
            $table->string('currency_format',20);
            $table->string('contact_phone',15);
            $table->string('contact_email',100);
            $table->string('contact_address',255);
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
        Schema::dropIfExists('options');
    }
};
