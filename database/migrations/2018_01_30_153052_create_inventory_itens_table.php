<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryItensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_itens', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->double('price');
            $table->integer('depreciation_time');
            $table->double('depreciation_value');
            $table->double('depreciated')->default(0);
            $table->integer('farm_id');
            $table->boolean('sold')->default(false);
            $table->double('sold_price')->nullable();
            $table->date('sold_date')->nullable();
            $table->integer('income_id')->nullable();;
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
        Schema::dropIfExists('inventory_itens');
    }
}
