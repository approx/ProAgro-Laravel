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
    $crops = Crop::with(['field.farm.address','culture','activities','field.farm.client.user:id'])->get();
    $filtered = $crops->filter(function($value,$key){
      return $value->field->farm->client->user->id === Auth::id();
    });

    return $filtered->values();
  }

  public function store()
  {
    $crop =  Crop::create(request()->all());
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
    $crop->field->farm->address;
    $crop->culture;
    $crop->activities;
    $crop->field->farm->client;
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
