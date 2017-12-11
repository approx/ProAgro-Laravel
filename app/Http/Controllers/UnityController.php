<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unity;

class UnityController extends Controller
{
  public function index()
  {
    return Unity::all();
  }

  public function store()
  {
    return Unity::create(request()->all());
  }

  public function get(Unity $unity)
  {
    return $unity;
  }

  public function update(Unity $unity)
  {
    $unity->fill(request()->all());
    $unity->save();
    return $unity;
  }

  public function delete(Unity $unity)
  {
    $unity->delete();
    return 'unity deleted';
  }

  
}
