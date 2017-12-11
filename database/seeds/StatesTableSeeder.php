<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
          ['id'=>'AC','name'=>'Acre'],
          ['id'=>'AL','name'=>'Alagoas'],
          ['id'=>'AP','name'=>'Amapa'],
          ['id'=>'AM','name'=>'Amazonas'],
          ['id'=>'BA','name'=>'Bahia'],
          ['id'=>'CE','name'=>'Ceará'],
          ['id'=>'DF','name'=>'Distrito Federal'],
          ['id'=>'ES','name'=>'Espirito Santo'],
          ['id'=>'GO','name'=>'Goiãs'],
          ['id'=>'MA','name'=>'Maranhão'],
          ['id'=>'MT','name'=>'Mato Grosso'],
          ['id'=>'MS','name'=>'Mato Grosso do Sul'],
          ['id'=>'MG','name'=>'Minas Gerais'],
          ['id'=>'PA','name'=>'Pará'],
          ['id'=>'PB','name'=>'Paraíba'],
          ['id'=>'PR','name'=>'Paraná'],
          ['id'=>'PE','name'=>'Pernambuco'],
          ['id'=>'PI','name'=>'Piauí'],
          ['id'=>'RJ','name'=>'Rio de Janeiro'],
          ['id'=>'RN','name'=>'Rio Grande do Norte'],
          ['id'=>'RS','name'=>'Rio Grande do Sul'],
          ['id'=>'RO','name'=>'Rôndonia'],
          ['id'=>'RR','name'=>'Roraima'],
          ['id'=>'SC','name'=>'Santa Catarina'],
          ['id'=>'SP','name'=>'São Paulo'],
          ['id'=>'SE','name'=>'Sergipe'],
          ['id'=>'TO','name'=>'Tocantins']
        ]);
    }
}
