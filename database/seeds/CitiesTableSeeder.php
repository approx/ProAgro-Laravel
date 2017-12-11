<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
          ['name'=>'Contagem','state_id'=>'MG'],
          ['name'=>'Belo Horizonte','state_id'=>'MG'],
          ['name'=>'Betim','state_id'=>'MG'],
          ['name'=>'Sabara','state_id'=>'MG']
        ]);
    }
}
