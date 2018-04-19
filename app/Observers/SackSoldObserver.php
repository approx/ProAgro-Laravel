<?php
namespace App\Observers;

use App\SackSold;
use App\Crop;
use App\IncomeHistory;
use Carbon\Carbon;

class SackSoldObserver{
  public function creating(SackSold $sackSold)
  {
    $crop = Crop::find($sackSold->crop_id);
    $income = IncomeHistory::create(['farm_id'=>$crop->field->farm->id,'value'=>($sackSold->quantity*$sackSold->value),'date'=>Carbon::now(),'description'=>$crop->name.' - '.$sackSold->quantity.' sacas vendida(s)','expense'=>false]);
    $sackSold->income_id = $income->id;
  }
  public function deleting(SackSold $sackSold)
  {
    $farm = $sackSold->income->farm;
    $sackSold->income->delete();
    $farm->CalculateIncome();
  }
}
