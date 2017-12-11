<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;

class CityController extends Controller
{
  public function index()
  {
    return City::all();
  }

  public function delete(City $city)
  {
    $city->delete()
    return 'City deleted';
  }
}
