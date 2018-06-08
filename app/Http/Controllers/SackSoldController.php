<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SackSold;
use Illuminate\Support\Facades\Auth;

class SackSoldController extends Controller
{
    public function delete(SackSold $sack_sold)
    {
      if($sack_sold->crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this crop',400);

      $sack_sold->delete();
      return 'Sack deleted';
    }
}
