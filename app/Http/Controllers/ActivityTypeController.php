<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivityType;

class ActivityTypeController extends Controller
{
  public function index()
  {
    return ActivityType::with(['unity'])->get();
  }

  public function store()
  {
    return ActivityType::create(request()->all());
  }

  public function get(ActivityType $activityType)
  {
    $activityType->unity;
    return $activityType;
  }

  public function update(ActivityType $activityType)
  {
    $activityType->fill(request()->all());
    $activityType->save();
    return $activityType;
  }

  public function delete(ActivityType $activityType)
  {
    $activityType->delete();
    return 'activityType deleted';
  }

  public function activities(ActivityType $activityType)
  {
    return $activityType->activities;
  }
}
