<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivityType;
use App\Log;

class ActivityTypeController extends Controller
{
  public function index()
  {
    return ActivityType::with(['unity','group'])->get();
  }

  public function store()
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/activity_types','action'=>'create','request'=>request()->getContent()]);
    $activityType = ActivityType::create(request()->all());
    $log->done();
    return $activityType;
  }

  public function get(ActivityType $activityType)
  {
    $activityType->unity;
    return $activityType;
  }

  public function update(ActivityType $activityType)
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/activity_type/'.$activityType->id,'action'=>'update','request'=>request()->getContent()]);
    $activityType->fill(request()->all());
    $activityType->save();
    $log->done();
    return $activityType;
  }

  public function delete(ActivityType $activityType)
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/activity_type/'.$activityType->id,'action'=>'delete','request'=>request()->getContent()]);
    $activityType->delete();
    $log->done();
    return 'activityType deleted';
  }

  public function activities(ActivityType $activityType)
  {
    return $activityType->activities;
  }
}
