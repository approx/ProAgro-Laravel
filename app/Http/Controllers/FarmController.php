<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farm;
use Illuminate\Support\Facades\Auth;

class FarmController extends Controller
{
  public function index()
  {
    $farms = Farm::with(['cultures','fields','address.city.state','client.address','client.user','inventory_itens'])->orderBy('name')->get();
    $filtered = $farms->filter(function ($value,$key) {
      return $value->client->user->id === Auth::id() || Auth::user()->role->name=='master';
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

  public function get(Farm $farm)
  {
    if($farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this farm',400);
    $farm->inventory_itens;
    $farm->cultures;
    $farm->fields;
    $farm->address->city->state;
    $farm->client->address;
    return $farm;
  }

  public function update(Farm $farm)
  {
    if($farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this farm',400);
    $farm->fill(request()->all());
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
