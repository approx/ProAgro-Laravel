<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditInventoryIten extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('inventory_itens_crop', function (Blueprint $table) {
          $table->integer('crop_id');
          $table->integer('inventory_iten_id');
          $table->timestamps();
      });
      Schema::table('inventory_itens',function (Blueprint $table) {
          $table->boolean('propagateByProduction')->default(false);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('inventory_itens_crop');
      Schema::table('inventory_itens',function (Blueprint $table) {
          $table->dropColumn('propagateByProduction');
      });
    }
}
