<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Crop;
use App\Field;
use Illuminate\Support\Facades\Auth;

class CropController extends Controller
{
  public function index()
  {
    $crops = Crop::with(['field.farm','culture','activities','field.farm.client.user:id','inventory_itens'])->get();
    $filtered = $crops->filter(function($value,$key){
      return $value->field->farm->client->user->id === Auth::id() || Auth::user()->role->name=='master';
    });

    return $filtered->values();
  }

  public function store()
  {
    $crop =  Crop::create(request()->all());
    if(request()->itens){
      $crop->inventory_itens()->attach(preg_split("/;/",request()->itens));
    }
    $final_date = Carbon::createFromFormat('Y-m-d', request()->final_date);
    if($final_date->isFuture()){
      $field = Field::find(request()->field_id);
      $field->actual_crop = $crop->id;
      $field->save();
    }
    return $crop;
  }

  public function get(Crop $crop)
  {
    if($crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this crop',400);
    $crop->field->farm->address;
    $crop->culture;
    $crop->activities;
    $crop->field->farm->client;
    $crop->inventory_itens;
    return $crop;
  }

  public function update(Crop $crop)
  {
    if($crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this crop',400);

    $crop->fill(request()->all());
    $crop->save();
    return $crop;
  }

  public function delete(Crop $crop)
  {
    if($crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this crop',400);

    $crop->delete();
    return 'crop deleted';
  }
}
