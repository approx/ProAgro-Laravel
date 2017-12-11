<?php

namespace App\Observers;

use App\Crop;

class CropObserver
{

  public function creating(Crop $crop)
  {
    if(is_string($crop->initial_date)){
      $crop->initial_date = \Carbon\Carbon::createFromFormat('d/m/Y',$crop->initial_date,'America/Sao_Paulo')->toDateTimeString();
    }
    if(is_string($crop->final_date)){
      $crop->final_date = \Carbon\Carbon::createFromFormat('d/m/Y',$crop->final_date,'America/Sao_Paulo')->toDateTimeString();
    }
  }

  public function updating(Crop $crop)
  {
    if(is_string($crop->initial_date)){
      $crop->initial_date = \Carbon\Carbon::createFromFormat('d/m/Y',$crop->initial_date,'America/Sao_Paulo')->toDateTimeString();
    }
    if(is_string($crop->final_date)){
      $crop->final_date = \Carbon\Carbon::createFromFormat('d/m/Y',$crop->final_date,'America/Sao_Paulo')->toDateTimeString();
    }
  }
}
