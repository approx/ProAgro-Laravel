<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Crop;
class CropController extends Controller
{
  public function index()
  {
    return Crop::all();
  }

  public function store()
  {
    return Crop::create(request()->all());
  }

  public function get(Crop $crop)
  {
    return $crop;
  }

  public function update(Crop $crop)
  {
    $crop->fill(request()->all());
    $crop->save();
    return $crop;
  }

  public function delete(Crop $crop)
  {
    $crop->delete();
    return 'crop deleted';
  }

  public function field(Crop $crop)
  {
    return $crop->field;
  }

  public function culture(Crop $crop)
  {
    return $crop->culture;
  }

  public function activities(Crop $crop)
  {
    return $crop->activities;
  }
}
