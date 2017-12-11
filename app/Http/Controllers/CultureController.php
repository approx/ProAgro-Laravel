<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Culture;

class CultureController extends Controller
{
    public function index()
    {
      return Culture::all();
    }

    public function get(Culture $culture)
    {
      return $culture;
    }

    public function delete(Culture $culture)
    {
      $culture->delete();
      return 'Culture deleted';
    }

    public function farms(Culture $culture)
    {
      return $culture->farms;
    }

    public function store()
    {
      return Culture::create(request()->all());
    }

    public function crops(Culture $culture)
    {
      return $culture->crops;
    }
}
