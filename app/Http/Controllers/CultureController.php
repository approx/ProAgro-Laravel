<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Log;
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
      $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/cultures/'.$culture->id,'action'=>'delete','request'=>request()->getContent()]);
      $culture->delete();
      $log->done();
      return 'Culture deleted';
    }

    public function farms(Culture $culture)
    {
      return $culture->farms;
    }

    public function store()
    {
      $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/cultures','action'=>'create','request'=>request()->getContent()]);
      $culture = Culture::create(request()->all());
      $log->done();
      return $culture;
    }

    public function crops(Culture $culture)
    {
      return $culture->crops;
    }
}
