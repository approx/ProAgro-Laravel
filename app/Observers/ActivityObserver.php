<?php

namespace App\Observers;

use App\Activity;
use App\IncomeHistory;
use App\Crop;
use App\ActivityType;

class ActivityObserver
{

  public function creating(Activity $activity)
  {
    $crop = Crop::find($activity->crop_id);
    $activityType = ActivityType::find($activity->activity_type_id);
    $income;
    try{
      $income = IncomeHistory::create(['farm_id'=>$crop->field->farm->id,'value'=>$activity->total_value,'date'=>$activity->payment_date,'description'=>'Atividade: '.$activityType->id.' - '.$activity->product_name.', safra: '.$crop->name,'expense'=>true]);
    } catch(Exception $e){
        return false;
    }

    $activity->income_id = $income->id;
  }

  public function updating(Activity $activity)
  {
    $crop = Crop::find($activity->crop_id);
    $activityType = ActivityType::find($activity->activity_type_id);
    $activity->income->value = $activity->total_value;
    $activity->income->date = $activity->payment_date;
    $activity->income->description = 'Atividade: '.$activityType->name.', safra: '.$crop->name;
    $activity->income->save();
  }

  public function deleting(Activity $activity)
  {
    $farm = $activity->income->farm;
    $activity->income->delete();
    $farm->CalculateIncome();
  }
}
