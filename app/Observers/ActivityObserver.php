<?php

namespace App\Observers;

use App\Activity;
use App\IncomeHistory;
use App\Crop;
use App\ActivityType;

class ActivityObserver
{
  public function saving(Activity $activity)
  {
    $activity->value_per_ha = $activity->total_value/$activity->crop->field->area;
  }
}
