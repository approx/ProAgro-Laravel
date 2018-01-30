<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Field;

class FieldController extends Controller
{
  public function index()
  {
    return Field::with(['crop.field.farm','crops','farm.address.city.state','farm.client'])->orderBy('name')->get();
  }

  public function store()
  {
    return Field::create(request()->all());
  }

  public function get(Field $field)
  {
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
    $field->fill(request()->all());
    $field->save();
    return $field;
  }

  public function delete(Field $field)
  {
    $field->delete();
    return 'field deleted';
  }

  public function crops(Field $field)
  {
    return $field->crops;
  }

  public function crop(Field $field)
  {
    return $field->crop;
  }

  public function farm(Field $field)
  {
    return $field->farm;
  }
}
