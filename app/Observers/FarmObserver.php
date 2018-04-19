<?php

namespace App\Observers;

use App\Farm;

class FarmObserver{

  public function deleting(Farm $farm)
  {
    $fields = $farm->fields;
    // echo $fields;
    // return false;
    for ($i=0; $i < count($fields); $i++) {
      $fields[$i]->delete();
    }
  }
}
