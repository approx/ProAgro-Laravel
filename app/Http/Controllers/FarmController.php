<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farm;
use App\Stock;
use App\Log;
use Illuminate\Support\Facades\Auth;

class FarmController extends Controller
{
  public function index()
  {
    $farms = Farm::with(['cultures','fields','propagate_activities','client.address','client.user','inventory_itens','stocks'])->orderBy('name')->get();
    $filtered = $farms->filter(function ($value,$key) {
      return $value->client->user->id === Auth::id() || Auth::user()->role->name=='master' || $value->client->client_user == Auth::id();
    });
    return $filtered->values();
  }

  public function store()
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/farms','action'=>'create','request'=>request()->getContent()]);
    $farm = Farm::create(request()->all());
    if(request()->cultures){
      $farm->cultures()->attach(preg_split("/;/",request()->cultures));
    }
    $log->done();
    return $farm;
  }

  public function crops(Farm $farm)
  {
    $crops = [];
    foreach ($farm->fields as $field) {
      foreach ($field->crops as $crop) {
        array_push($crops,$crop);
      }
    }
    return $crops;
  }

  public function createStock(Farm $farm)
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/farm/'.$farm->id.'/stock','action'=>'update','request'=>request()->getContent()]);
    if($farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this farm',400);

    request()->validate([
      'activity_type_id'=>'required',
      'quantity'=>'required|numeric',
      'unity_value'=>'required',
      'product_name'=>'required'
    ]);
    $log->done();
    return Stock::create(request()->all()+['farm_id'=>$farm->id]);
  }

  public function getStocks(Farm $farm)
  {
    return $farm->stocks;
  }

  public function get(Farm $farm)
  {
    if($farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master' && $farm->client->client_user!=Auth::id()) return response('you dont have access to this farm',400);
    $farm->inventory_itens;
    $farm->cultures;
    $farm->fields;
    $farm->stocks;
    $farm->client->address;
    $farm->propagate_activities;
    return $farm;
  }

  public function indicators(Farm $farm){
    $ind = ['planted_area'=>$farm->PlantedArea(),'area_available'=>$farm->FieldAreas()];
    return $ind;
  }

  public function update(Farm $farm)
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/farm/'.$farm->id,'action'=>'update','request'=>request()->getContent()]);
    if($farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this farm',400);
    $farm->fill(request()->all());
    $farm->cultures()->detach();
    $farm->cultures()->attach(preg_split("/;/",request()->cultures));
    $farm->save();
    $log->done();
    return $farm;
  }

  public function delete(Farm $farm)
  {
    $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/farm/'.$farm->id,'action'=>'delete','request'=>request()->getContent()]);
    if($farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this farm',400);
    $farm->delete();
    $log->done();
    return 'Farm deleted';
  }
}
