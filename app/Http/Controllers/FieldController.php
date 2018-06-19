<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Field;
use Illuminate\Support\Facades\Auth;
use App\Log;

class FieldController extends Controller
{
  public function index()
  {
    $fields = Field::with(['crop.field.farm','crops','farm.client.user:id','field_type'])->orderBy('name')->get();
    $filtered = $fields->filter(function($value,$key){
      return $value->farm->client->user->id === Auth::id() || Auth::user()->role->name=='master' || $value->farm->client->client_user == Auth::id();
    });

    return $filtered->values();
  }

  public function store()
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/fields','action'=>'create','request'=>request()->getContent()]);
    $field = Field::create(request()->all());
    $log->done();
    return $field;
  }

  public function get(Field $field)
  {
    if($field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master' && $field->farm->client->client_user!=Auth::id()) return response('you dont have access to this field',400);
    if($field->crop){
      $field->crop->field->farm;
    }
    $field->field_type;
    $field->crops;
    $field->farm->client;
    return $field;
  }

  public function update(Field $field)
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/field/'.$field->id,'action'=>'update','request'=>request()->getContent()]);
    if($field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this field',400);
    $field->fill(request()->all());
    $field->save();
    $log->done();
    return $field;
  }

  public function delete(Field $field)
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/field/'.$field->id,'action'=>'delete','request'=>request()->getContent()]);
    if($field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this field',400);
    $field->delete();
    $log->done();
    return 'field deleted';
  }
}
