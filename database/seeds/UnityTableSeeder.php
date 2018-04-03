<?php

use Illuminate\Database\Seeder;

class UnityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unities')->insert([
          ['id'=>'L','name'=>'Litros'],
          ['id'=>'Kg','name'=>'Kilogramas'],
          ['id'=>'Ton','name'=>'Toneladas'],
          ['id'=>'R$','name'=>'Reais'],
          ['id'=>'Kw','name'=>'Kilowatt'],
          ['id'=>'Sc','name'=>'Sacas']
        ]);
    }
}
