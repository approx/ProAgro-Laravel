<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\IncomeHistory;
use App\ActivityType;
use App\Crop;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
  public function index()
  {
    $activities = Activity::with(['crop.field.farm.client.user:id','activity_type','unity'])->get();
    $filtered = $activities->filter(function($value,$key){
      return $value->crop->field->farm->client->user->id === Auth::id() || Auth::user()->role->name=='master' || $value->crop->field->farm->client->client_user===Auth::id();
    });

    return $filtered->values();
  }

  public function store()
  {
    request()->validate([
      'crop_id'=>'required',
      'operation_date'=>'required',
      'payment_date'=>'required',
      'activity_type_id'=>'required',
      'total_value'=>'required',
      'unity_id'=>'required',
    ]);
    return Activity::create(request()->all());
  }

  public function multipleStore()
  {
    request()->validate([
      'crops'=>'required',
      'operation_date'=>'required',
      'payment_date'=>'required',
      'activity_type_id'=>'required',
      'total_value'=>'required',
      'unity_id'=>'required',
    ]);
    $crops = explode(';',request()->crops);
    foreach ($crops as $crop) {
      Activity::create(request()->all()+['crop_id'=>$crop]);
    }
    return 'activities saved';
  }

  public function get(Activity $activity)
  {
    if($activity->crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this activity',400);
    $activity->crop->field->farm->client;
    $activity->activity_type;
    $activity->unity;
    return $activity;
  }

  public function update(Activity $activity)
  {

    if($activity->crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this activity',400);

    $activity->fill(request()->all());
    $activity->save();
    return $activity;
  }

  public function delete(Activity $activity)
  {
    if($activity->crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this activity',400);

    $activity->delete();
    return 'activity deleted';
  }
}
