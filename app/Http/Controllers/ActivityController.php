<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\IncomeHistory;
use App\ActivityType;
use App\Crop;
use App\Log;
use App\Farm;
use App\PropagateActivity;
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
      'total_value'=>'required',
      'farm_id'=>'required'
    ]);
    $crops = explode(';',request()->crops);
    $activitiesIds='';
    $farm = Farm::find(request()->farm_id);
    foreach ($crops as $cropId) {
      $currency;
      if($farm->currency_id=='USD'){
        $currency='$ ';
      }else {
        $currency='R$ ';
      }
      $activityType = ActivityType::find(request()->activity_type_id);
      $crop = Crop::find($cropId);
      if(isset(request()->product_name)){
        $activity = request()->all()+['crop_id'=>$crop->id];
        $activity['product_name'] ='Rateio completo - '.request()->product_name;
      }else {
        $activity = request()->all()+['crop_id'=>$crop->id,'product_name'=>'Rateio completo - '.$activityType->name];
      }
      $activity=Activity::create($activity);
      $activitiesIds = $activitiesIds.$activity->id.';';
    }
    $activitiesIds = substr($activitiesIds,0,-1);
    PropagateActivity::create(['farm_id'=>request()->farm_id,'activities_ids'=>$activitiesIds,'total_value'=>request()->total_value]);
    $log->done();
    return 'activities saved';
  }

  function moeda($get_valor) {
    $source = array('.', ',');
    $replace = array('', '.');
    $valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
    return $valor; //retorna o valor formatado para gravar no banco
  }

  public function percentageMultipleStore()
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/percentage-multiple-activities','action'=>'create','request'=>request()->getContent()]);
    request()->validate([
      'crops'=>'required',
      'operation_date'=>'required',
      'payment_date'=>'required',
      'activity_type_id'=>'required',
      'total_value'=>'required',
      'farm_id'=>'required'
    ]);
    $crops = explode(';',request()->crops);
    $sumOfSizes=Farm::find(request()->farm_id)->area_planted;
    $activitiesIds='';
    $farm = Farm::find(request()->farm_id);
    foreach ($crops as $cropId) {
      $currency;
      if($farm->currency_id=='USD'){
        $currency='$ ';
      }else {
        $currency='R$ ';
      }
      $crop = Crop::find($cropId);
      $activityType = ActivityType::find(request()->activity_type_id);
      if(isset(request()->product_name)){
        $activity = request()->all()+['crop_id'=>$crop->id];
        $activity['product_name'] ='Rateade de '.$currency.number_format(request()->total_value,2,',','.').' - '.request()->product_name;
      }else {
        $activity = request()->all()+['crop_id'=>$crop->id,'product_name'=>'Rateade de '.$currency.number_format(request()->total_value,2,',','.').' - '.$activityType->name];
      }
      // return $activity;
      $activity['total_value'] = number_format(($crop->field->area/$sumOfSizes)*request()->total_value, 3,'.','');
      $activityCreate = Activity::create($activity);
      $activitiesIds = $activitiesIds.$activityCreate->id.';';
    }
    $activitiesIds = substr($activitiesIds,0,-1);
    PropagateActivity::create(['farm_id'=>request()->farm_id,'activities_ids'=>$activitiesIds,'total_value'=>request()->total_value]);
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
