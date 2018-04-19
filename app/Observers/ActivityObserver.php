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
    if(is_string($activity->operation_date)){
      $activity->operation_date = \Carbon\Carbon::createFromFormat('d/m/Y',$activity->operation_date,'America/Sao_Paulo')->toDateTimeString();
    }
    if(is_string($activity->payment_date)){
      $activity->payment_date = \Carbon\Carbon::createFromFormat('d/m/Y',$activity->payment_date,'America/Sao_Paulo')->toDateTimeString();
    }
  }

  public function updating(Activity $activity)
  {
    $crop = Crop::find($activity->crop_id);
    $activityType = ActivityType::find($activity->activity_type_id);
    $activity->income->value = $activity->total_value;
    $activity->income->date = $activity->payment_date;
    $activity->income->description = 'Atividade: '.$activityType->name.', safra: '.$crop->name;
    $activity->income->save();

    if(is_string($activity->operation_date)){
      $activity->operation_date = \Carbon\Carbon::createFromFormat('d/m/Y',$activity->operation_date,'America/Sao_Paulo')->toDateTimeString();
    }
    if(is_string($activity->payment_date)){
      $activity->payment_date = \Carbon\Carbon::createFromFormat('d/m/Y',$activity->payment_date,'America/Sao_Paulo')->toDateTimeString();
    }
  }

  public function deleting(Activity $activity)
  {
    $farm = $activity->income->farm;
    $activity->income->delete();
    $farm->CalculateIncome();
  }
}
