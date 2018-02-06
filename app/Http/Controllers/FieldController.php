<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Field;
use Illuminate\Support\Facades\Auth;

class FieldController extends Controller
{
  public function index()
  {
    $fields = Field::with(['crop.field.farm','crops','farm.address.city.state','farm.client.user:id'])->orderBy('name')->get();
    $filtered = $fields->filter(function($value,$key){
      return $value->farm->client->user->id === Auth::id();
    });

    return $filtered->values();
  }

  public function store()
  {
    return Field::create(request()->all());
  }

  public function get(Field $field)
  {
    if($field->farm->client->user->id!=Auth::id()) return response('you dont have access to this field',400);
    if($field->crop){
      $field->crop->field->farm;
    }
    $field->crops;
    $field->farm->client;
    $field->farm->address->city->state;
    return $field;
  }

  public function update(Field $field)
  {
    if($field->farm->client->user->id!=Auth::id()) return response('you dont have access to this field',400);
    $field->fill(request()->all());
    $field->save();
    return $field;
  }

  public function delete(Field $field)
  {
    if($field->farm->client->user->id!=Auth::id()) return response('you dont have access to this field',400);
    $field->delete();
    return 'field deleted';
  }
}
