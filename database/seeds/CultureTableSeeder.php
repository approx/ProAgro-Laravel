<?php

use Illuminate\Database\Seeder;

class CultureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('cultures')->insert([
        ['name'=>'Feijão'],
        ['name'=>'Milho'],
        ['name'=>'Soja'],
        ['name'=>'Batata'],
      ]);
    }
}
