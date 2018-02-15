<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',45);
            $table->string('email',50)->nullable();
            $table->string('phone',11);
            $table->string('phone_2',11)->nullable();
            $table->string('inscription_number',30);
            $table->string('cpf_cnpj',15);
            $table->integer('address_id');
            $table->integer('user_id');
            $table->integer('client_user')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
