<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('currencies')->insert([
        ['id'=>'BRL','name'=>'Real'],
        ['id'=>'USD','name'=>'Dolar']
      ]);
    }
}
