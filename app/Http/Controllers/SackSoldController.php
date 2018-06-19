<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SackSold;
use Illuminate\Support\Facades\Auth;
use App\Log;

class SackSoldController extends Controller
{
    public function delete(SackSold $sack_sold)
    {
      $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/sack_sold/'.$sack_sold->id,'action'=>'delete','request'=>request()->getContent()]);
      if($sack_sold->crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this crop',400);

      $sack_sold->delete();
      $log->done();
      return 'Sack deleted';
    }
}
