<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farm;
use App\Stock;
use Illuminate\Support\Facades\Auth;

class FarmController extends Controller
{
  public function index()
  {
    $farms = Farm::with(['cultures','fields','client.address','client.user','inventory_itens','income_histories.activity','income_histories.inventory_iten','income_histories.sack_sold','stocks'])->orderBy('name')->get();
    $filtered = $farms->filter(function ($value,$key) {
      return $value->client->user->id === Auth::id() || Auth::user()->role->name=='master' || $value->client->client_user == Auth::id();
    });

    return $filtered->values();
  }

  public function store()
  {
    $farm = Farm::create(request()->all());
    if(request()->cultures){
      $farm->cultures()->attach(preg_split("/;/",request()->cultures));
    }
    return $farm;
  }

  public function createStock(Farm $farm)
  {
    if($farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this farm',400);

    request()->validate([
      'activity_type_id'=>'required',
      'quantity'=>'required|numeric',
      'unity_value'=>'required',
      'product_name'=>'required'
    ]);

    return Stock::create(request()->all()+['farm_id'=>$farm->id]);
  }

  public function get(Farm $farm)
  {
    if($farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master' && $farm->client->client_user!=Auth::id()) return response('you dont have access to this farm',400);
    $farm->inventory_itens;
    $farm->cultures;
    $farm->fields;
    $farm->stocks;
    $farm->income_histories;
    $farm->client->address;
    return $farm;
  }

  public function indicators(Farm $farm){
    $ind = ['planted_area'=>$farm->PlantedArea(),'area_available'=>$farm->FieldAreas()];
    return $ind;
  }

  public function update(Farm $farm)
  {
    if($farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this farm',400);
    $farm->fill(request()->all());
    $farm->cultures()->detach();
    $farm->cultures()->attach(preg_split("/;/",request()->cultures));
    $farm->save();
    return $farm;
  }

  public function delete(Farm $farm)
  {
    if($farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this farm',400);
    $farm->delete();
    return 'Farm deleted';
  }
}
