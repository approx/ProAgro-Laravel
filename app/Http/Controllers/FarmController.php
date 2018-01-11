<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farm;

class FarmController extends Controller
{
  public function index()
  {
    return Farm::with(['cultures','fields','address','client.address'])->get();
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
    return $farm;
  }

  public function fields(Farm $farm)
  {
    return $farm->fields;
  }

  public function cultures(Farm $farm)
  {
    return $farm->cultures;
  }

  public function address(Farm $farm)
  {
    return $farm->address;
  }

  public function client(Farm $farm)
  {
    return $farm->client;
  }

  public function update(Farm $farm)
  {
    $farm->fill(request()->all());
    $farm->save();
    return $farm;
  }

  public function delete(Farm $farm)
  {
    $farm->delete();
    return 'Farm deleted';
  }
}
