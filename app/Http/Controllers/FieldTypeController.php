<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FieldType;

class FieldTypeController extends Controller
{
    public function index()
    {
      return FieldType::all();
    }

    public function store()
    {
      return FieldType::create(request->all());
    }

    public function get(FieldType $fieldType)
    {
      return $fieldType;
    }

    public function delete(FieldType $fieldType)
    {
      $fieldType->delete();
      return 'Field Type deleted';
    }
}
