<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Farm;

class FarmController extends Controller
{
  public function index()
  {
    return Farm::all();
  }

  public function store()
  {
    return Farm::create(request()->all());
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
