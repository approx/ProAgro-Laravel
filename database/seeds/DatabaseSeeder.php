<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StatesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FieldTypesTableSeeder::class);
        $this->call(ActivityTypeTableSeeder::class);
        $this->call(CultureTableSeeder::class);
        $this->call(UnityTableSeeder::class);
    }
}
