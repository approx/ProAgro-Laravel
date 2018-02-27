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
      return $value->crop->field->farm->client->user->id === Auth::id() || Auth::user()->role->name=='master';
    });

    return $filtered->values();
  }

  public function store()
  {
    $crop = Crop::find(request()->crop_id);
    $activityType = ActivityType::find(request()->activity_type_id);
    IncomeHistory::create(['farm_id'=>$crop->field->farm->id,'value'=>request()->total_value,'date'=>request()->payment_date,'description'=>'Atividade: '.$activityType->name.', safra: '.$crop->name,'expense'=>true]);
    $crop->field->farm->CalculateIncome();
    return Activity::create(request()->all());
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
