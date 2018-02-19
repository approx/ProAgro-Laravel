<?php

use Illuminate\Database\Seeder;

class ActivityTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('activity_types')->insert([
          ['id'=>'AD01','name'=>'Adubo 01','unity_value'=>30.25]
        ]);
    }
}
