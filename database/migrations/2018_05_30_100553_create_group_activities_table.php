<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_activities', function (Blueprint $table) {
            $table->string('id',10);
            $table->string('name');
            $table->timestamps();
        });
        Schema::table('activity_types',function (Blueprint $table) {
            $table->string('group_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_activities');
        Schema::table('activity_types',function (Blueprint $table) {
            $table->dropColumn('group_id');
        });
    }
}
