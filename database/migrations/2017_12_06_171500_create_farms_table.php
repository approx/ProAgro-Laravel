<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',45);
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->integer('client_id');
            $table->double('ha');
            $table->double('value_ha');
            $table->double('capital_tied');
            $table->double('remuneration');
            $table->double('income')->default(0);
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
        Schema::dropIfExists('farms');
    }
}
