<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveIncome extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('income_histories');
        Schema::table('activities', function (Blueprint $table) {
          $table->dropColumn('income_id');
        });
        Schema::table('inventory_itens', function (Blueprint $table) {
          $table->dropColumn('income_id');
        });
        Schema::table('sack_solds', function (Blueprint $table) {
          $table->dropColumn('income_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
