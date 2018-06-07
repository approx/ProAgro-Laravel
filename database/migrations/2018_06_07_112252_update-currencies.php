<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCurrencies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('stocks',function (Blueprint $table) {
          $table->dropColumn('currency_id');
      });
      Schema::table('sack_solds',function (Blueprint $table) {
          $table->dropColumn('currency_id');
      });
      Schema::table('activities',function (Blueprint $table) {
          $table->dropColumn('currency_id');
      });
      Schema::table('inventory_itens',function (Blueprint $table) {
          $table->dropColumn('currency_id');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('stocks',function (Blueprint $table) {
          $table->string('currency_id',10)->default('BRL');
      });
      Schema::table('sack_solds',function (Blueprint $table) {
          $table->string('currency_id',10)->default('BRL');
      });
      Schema::table('activities',function (Blueprint $table) {
          $table->string('currency_id',10)->default('BRL');
      });
      Schema::table('inventory_itens',function (Blueprint $table) {
          $table->string('currency_id',10)->default('BRL');
      });
    }
}
