<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IndicatorsChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('farms',function (Blueprint $table) {
          $table->dropColumn('remuneration');
      });
      Schema::table('crops',function (Blueprint $table) {
          $table->double('interest_tax')->default(0.05);
          $table->double('sack_value')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('farms',function (Blueprint $table) {
          $table->double('remuneration');
      });
      Schema::table('crops',function (Blueprint $table) {
          $table->dropColumn('interest_tax');
          $table->dropColumn('sack_value');
      });
    }
}
