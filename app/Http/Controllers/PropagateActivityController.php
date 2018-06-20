<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropagateActivity;
use App\Activity;

class PropagateActivityController extends Controller
{
    public function delete(PropagateActivity $propagateActivity)
    {
      $crops = explode(';',request()->crops);
      $activities = explode(';',$propagateActivity->activities_ids);
      foreach ($activities as $activity) {
        Activity::where('id',$activity)->delete();
      }
      $propagateActivity->delete();
      return 'deleted';
    }
}
