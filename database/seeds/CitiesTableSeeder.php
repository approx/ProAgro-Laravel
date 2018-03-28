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
      $inserts = [];
      $handle = fopen("database/seeds/municipios.csv", "r");
      if ($handle) {
        while (($line = fgetcsv($handle)) !== false) {
          array_push($inserts,['state_id'=>$line[0],'name'=>$line[1]]);
        }

        fclose($handle);
      } else {
        // error opening the file.
      }
      DB::table('cities')->insert($inserts);
        // DB::table('cities')->insert([
        //   ['name'=>'Contagem','state_id'=>'MG'],
        //   ['name'=>'Belo Horizonte','state_id'=>'MG'],
        //   ['name'=>'Betim','state_id'=>'MG'],
        //   ['name'=>'Sabara','state_id'=>'MG']
        // ]);
    }
}
