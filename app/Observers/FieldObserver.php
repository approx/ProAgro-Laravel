<?php

namespace App\Observers;

use App\Field;

class FieldObserver
{

  public function deleting(Field $field)
  {
    $crops = $field->crops;
    for ($i=0; $i < count($crops); $i++) {
      $crops[$i]->delete();
    }
  }
}
