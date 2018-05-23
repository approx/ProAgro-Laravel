<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->string('id',10);
            $table->string('name',10);
            $table->timestamps();
        });
        Schema::table('farms',function (Blueprint $table) {
            $table->string('currency_id',10)->default('BRL');
        });
        Schema::table('stocks',function (Blueprint $table) {
            $table->string('currency_id',10)->default('BRL');
        });
        Schema::table('activities',function (Blueprint $table) {
            $table->string('currency_id',10)->default('BRL');
        });
        Schema::table('inventory_itens',function (Blueprint $table) {
            $table->string('currency_id',10)->default('BRL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
