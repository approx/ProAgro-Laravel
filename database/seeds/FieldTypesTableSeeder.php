<?php

use Illuminate\Database\Seeder;

class FieldTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('field_types')->insert([
          ['name'=>'Irrigado'],
          ['name'=>'Sequeiro']
        ]);
    }
}
