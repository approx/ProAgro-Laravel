<?php

namespace App\Observers;

use App\Activity;

class ActivityObserver
{

  public function creating(Activity $activity)
  {
    if(is_string($activity->operation_date)){
      $activity->operation_date = \Carbon\Carbon::createFromFormat('d/m/Y',$activity->operation_date,'America/Sao_Paulo')->toDateTimeString();
    }
    if(is_string($activity->payment_date)){
      $activity->payment_date = \Carbon\Carbon::createFromFormat('d/m/Y',$activity->payment_date,'America/Sao_Paulo')->toDateTimeString();
    }
  }

  public function updating(Activity $activity)
  {
    if(is_string($activity->operation_date)){
      $activity->operation_date = \Carbon\Carbon::createFromFormat('d/m/Y',$activity->operation_date,'America/Sao_Paulo')->toDateTimeString();
    }
    if(is_string($activity->payment_date)){
      $activity->payment_date = \Carbon\Carbon::createFromFormat('d/m/Y',$activity->payment_date,'America/Sao_Paulo')->toDateTimeString();
    }
  }
}
