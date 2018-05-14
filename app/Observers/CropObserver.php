<?php

namespace App\Observers;

use App\Crop;

class CropObserver
{


  public function deleting(Crop $crop)
  {
    $activities = $crop->activities;
    for ($i=0; $i < count($activities); $i++) {
      $activities[$i]->delete();
    }
    $sacks = $crop->sack_solds;
    for ($i=0; $i < count($sacks); $i++) {
      $sacks[$i]->delete();
    }
  }
}
