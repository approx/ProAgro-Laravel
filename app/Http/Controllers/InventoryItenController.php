<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InventoryIten;
use App\IncomeHistory;
use Illuminate\Support\Facades\Auth;
use App\Log;

class InventoryItenController extends Controller
{
    public function index()
    {
      $itens = InventoryIten::with('farm.client.user:id')->where('sold',false)->orderBy('name')->get();

      $filteres = $itens->filter(function($value,$key){
        return $value->farm->client->user->id === Auth::id() || Auth::user()->role->name=='master';
      });

      return $filtered->values();
    }

    public function store()
    {
      $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/inventories','action'=>'create','request'=>request()->getContent()]);
      $item = InventoryIten::create(request()->all());
      $log->done();
      return $item;
    }

    public function get(InventoryIten $inventoryIten)
    {
      if($inventoryIten->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this iten',400);
      return $inventoryIten;
    }

    public function update(InventoryIten $inventoryIten)
    {
      $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/inventory/'.$inventoryIten->id,'action'=>'update','request'=>request()->getContent()]);
      if($inventoryIten->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this iten',400);

      $inventoryIten->fill(request()->all());

      $inventoryIten->save();
      $log->done();
      return $inventoryIten;
    }

    public function sell(InventoryIten $inventoryIten)
    {
      $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/inventory/'.$inventoryIten->id.'/sell','action'=>'update','request'=>request()->getContent()]);
      request()->validate([
        'sold_price'=>'required',
        'sold_date'=>'required',
        'propagateByProduction'=>'required',
        'crops'=>'required'
      ]);
      $inventoryIten->sold_price = request()->sold_price;
      $inventoryIten->sold_date = request()->sold_date;
      $inventoryIten->sold = true;
      $inventoryIten->propagateByProduction = request()->propagateByProduction;
      $inventoryIten->crops_sold()->attach(explode(';',request()->crops));
      $inventoryIten->save();
      $log->done();
      return 'iten selled';
    }

    public function delete(InventoryIten $inventoryIten)
    {
      $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/inventory/'.$inventoryIten->id,'action'=>'delete','request'=>request()->getContent()]);
      if($inventoryIten->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this iten',400);
      
      $inventoryIten->crops()->detach();
      $inventoryIten->crops_sold()->detach();
      $inventoryIten->delete();
      $log->done();
      return 'Invetory iten deleted';
    }
}
