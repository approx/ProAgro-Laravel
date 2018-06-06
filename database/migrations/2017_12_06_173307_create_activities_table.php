<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->date('operation_date');
            $table->date('payment_date');
            $table->string('product_name')->nullable();;
            $table->string('activity_type_id',10);
            $table->double('total_value');
            $table->double('value_per_ha')->nullable();
            $table->double('quantity')->nullable();
            $table->string('unity_id',10);
            $table->integer('income_id');
            $table->double('dose')->nullable();
            $table->integer('crop_id');
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
        Schema::dropIfExists('activities');
    }
}
