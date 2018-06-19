<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\IncomeHistory;
use App\ActivityType;
use App\Crop;
use App\Log;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
  public function index()
  {
    $activities = Activity::with(['crop.field.farm.client.user:id','activity_type.group','unity'])->get();
    $filtered = $activities->filter(function($value,$key){
      return $value->crop->field->farm->client->user->id === Auth::id() || Auth::user()->role->name=='master' || $value->crop->field->farm->client->client_user===Auth::id();
    });

    return $filtered->values();
  }

  public function store()
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/activities','action'=>'create','request'=>request()->getContent()]);
    request()->validate([
      'crop_id'=>'required',
      'operation_date'=>'required',
      'payment_date'=>'required',
      'activity_type_id'=>'required',
      'total_value'=>'required'
    ]);
    $activity = Activity::create(request()->all());
    $log->done();
    return $activity;
  }

  public function multipleStore()
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/multiple-activities','action'=>'create','request'=>request()->getContent()]);
    request()->validate([
      'crops'=>'required',
      'operation_date'=>'required',
      'payment_date'=>'required',
      'activity_type_id'=>'required',
      'total_value'=>'required'
    ]);
    $crops = explode(';',request()->crops);
    foreach ($crops as $crop) {
      Activity::create(request()->all()+['crop_id'=>$crop]);
    }
    $log->done();
    return 'activities saved';
  }

  public function percentageMultipleStore()
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/percentage-multiple-activities','action'=>'create','request'=>request()->getContent()]);
    request()->validate([
      'crops'=>'required',
      'operation_date'=>'required',
      'payment_date'=>'required',
      'activity_type_id'=>'required',
      'total_value'=>'required'
    ]);
    $crops = explode(';',request()->crops);
    $sumOfSizes=0;
    foreach ($crops as $cropId) {
      $crop = Crop::find($cropId);
      $sumOfSizes+= $crop->field->area;
    }
    foreach ($crops as $cropId) {
      $crop = Crop::find($cropId);
      $activity = request()->all()+['crop_id'=>$crop->id];
      $activity['total_value'] = number_format(($crop->field->area/$sumOfSizes)*request()->total_value, 3,'.','');
      Activity::create($activity);
    }
    $log->done();
    return 'activities saved';
  }

  public function get(Activity $activity)
  {
    if($activity->crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this activity',400);
    $activity->crop->field->farm->client;
    $activity->activity_type->group;
    $activity->unity;
    return $activity;
  }

  public function update(Activity $activity)
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/activity/'.$activity->id,'action'=>'update','request'=>request()->getContent()]);
    if($activity->crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this activity',400);

    $activity->fill(request()->all());
    $activity->save();
    $log->done();
    return $activity;
  }

  public function delete(Activity $activity)
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/activity/'.$activity->id,'action'=>'delete','request'=>request()->getContent()]);
    if($activity->crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this activity',400);

    $activity->delete();
    $log->done();
    return 'activity deleted';
  }
}
