<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;

class ActivityController extends Controller
{
  public function index()
  {
    return Activity::all();
  }

  public function store()
  {
    return Activity::create(request()->all());
  }

  public function get(Activity $activity)
  {
    return $activity;
  }

  public function update(Activity $activity)
  {
    $activity->fill(request()->all());
    $activity->save();
    return $activity;
  }

  public function delete(Activity $activity)
  {
    $activity->delete();
    return 'activity deleted';
  }

  public function activityType(Activity $activity)
  {
    return $activity->activity_type;
  }

  public function crop(Activity $activity)
  {
    return $activity->crop;
  }

  public function unity(Activity $activity)
  {
    return $activity->unity;
  }
}
