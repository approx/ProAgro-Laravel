<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Stock;
use App\Activity;
use App\StockHIstory;
use Illuminate\Support\Facades\Auth;
use App\Log;

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

    public function useStock(Stock $stock)
    {
      $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/stock/'.$stock->id,'action'=>'update','request'=>request()->getContent()]);
      request()->validate([
        'crop_id'=>'required',
        'quantity'=>'required|max:'.$stock->quantity,
        'operation_date'=>'required',
        'payment_date'=>'required'
      ]);

      $total_value = request()->quantity * $stock->unity_value;
      $stock->quantity = $stock->quantity - request()->quantity;
      $stock->save();

      $activity = Activity::create([
        'operation_date'=>request()->operation_date,
        'payment_date'=>request()->payment_date,
        'activity_type_id'=>$stock->activity_type_id,
        'total_value'=>$total_value,
        'quantity'=>request()->quantity,
        'unity_id'=>$stock->activity_type->unity_id,
        'product_name'=>$stock->product_name,
        'crop_id'=>request()->crop_id
      ]);

      try {
        StockHIstory::create(['stock_id'=>$stock->id,'quantity'=>request()->quantity]);
      } catch (\Exception $e) {
        $activity->delete();
      }
      $log->done();
      return $activity;

    }
}
