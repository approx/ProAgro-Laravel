<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   * Emprestimo - EMP
   * Mão de obra familiar - MOF
   * Administração - ADM
   * Pro Agro - PRO
   * Gestão Tecninca - GT
   * Formação/Renovação - FR
   * Adubação via Solo - ADS
   * Adubação via Folha - ADF
   * Controle de Pragas e Doenças - CPD
   * Controle de Plantas - CPL
   * Tratos Culturais - TRC
   * Irrigação - IRG
   * Colheita - COL
   * Pós-Colheita - PCOL
   * Comercialização - COM
   * Investimentos Realizados - INVS
   * @return void
   */
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('group_activities')->insert([
            ['id'=>'EMP','name'=>'Emprestimo'],
            ['id'=>'MOF','name'=>'Mão de obra familiar'],
            ['id'=>'ADM','name'=>'Administração'],
            ['id'=>'PRO','name'=>'Pro Agro'],
            ['id'=>'GT','name'=>'Gestão Tecninca'],
            ['id'=>'FR','name'=>'Formação/Renovação'],
            ['id'=>'ADS','name'=>'Adubação via Solo'],
            ['id'=>'ADF','name'=>'Adubação via Folha'],
            ['id'=>'CPD','name'=>'Controle de Pragas e Doenças'],
            ['id'=>'CPL','name'=>'Controle de Plantas'],
            ['id'=>'TRC','name'=>'Tratos Culturais'],
            ['id'=>'IRG','name'=>'Irrigação'],
            ['id'=>'COL','name'=>'Colheita'],
            ['id'=>'PCOL','name'=>'Pós-Colheita'],
            ['id'=>'COM','name'=>'Comercialização'],
            ['id'=>'INVS','name'=>'Investimentos Realizados']
          ]);

          $activities_types = DB::table('activity_types')->get();
          foreach ($activities_types as $type) {
            if(strpos($type->id,'ADM')!==false){
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'ADM']);
            }
            else if (strpos($type->id,'EMP')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'EMP']);
            }
            else if (strpos($type->id,'MOF')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'MOF']);
            }
            else if (strpos($type->id,'PRO')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'PRO']);
            }
            else if (strpos($type->id,'GT')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'GT']);
            }
            else if (strpos($type->id,'FR')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'FR']);
            }
            else if (strpos($type->id,'ADS')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'ADS']);
            }
            else if (strpos($type->id,'ADF')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'ADF']);
            }
            else if (strpos($type->id,'CPD')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'CPD']);
            }
            else if (strpos($type->id,'CPL')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'CPL']);
            }
            else if (strpos($type->id,'TRC')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'TRC']);
            }
            else if (strpos($type->id,'IRG')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'IRG']);
            }
            else if (strpos($type->id,'COL')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'COL']);
            }
            else if (strpos($type->id,'PCOL')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'PCOL']);
            }
            else if (strpos($type->id,'COM')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'COM']);
            }
            else if (strpos($type->id,'INVS')!==false) {
              DB::table('activity_types')->where('id',$type->id)->update(['group_id'=>'INVS']);
            }
          }
    }
}
