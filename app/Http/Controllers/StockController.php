<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stock;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    public function index()
    {
      $stocks = Stock::with(['farm.client.user:id','stock_histories','activity_type'])->get();
      $filtered = $stocks->filter(function($value,$key){
        return $value->farm->client->user->id === Auth::id() || Auth::user()->role->name=='master';
      });

      return $filtered->values();
    }

    public function get(Stock $stock)
    {
      if($stock->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this activity',400);

      $stock->stock_histories;

      return $stock;
    }
}
