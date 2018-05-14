<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InventoryIten;
use App\IncomeHistory;
use Illuminate\Support\Facades\Auth;

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
      return InventoryIten::create(request()->all());
    }

    public function get(InventoryIten $inventoryIten)
    {
      if($inventoryIten->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this iten',400);
      return $inventoryIten;
    }

    public function update(InventoryIten $inventoryIten)
    {
      if($inventoryIten->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this iten',400);

      $inventoryIten->fill(request()->all());

      $inventoryIten->save();
      return $inventoryIten;
    }

    public function sell(InventoryIten $inventoryIten)
    {
      $inventoryIten->sold_price = request()->sold_price;
      $inventoryIten->sold_date = request()->sold_date;
      $inventoryIten->sold = true;
      $income = IncomeHistory::create(['farm_id'=>$inventoryIten->farm->id,'value'=>$inventoryIten->sold_price,'date'=>$inventoryIten->sold_date,'description'=>'Iten vendido: '.$inventoryIten->name,'expense'=>false]);
      $inventoryIten->income_id = $income->id;
      $inventoryIten->farm->CalculateIncome();
      $inventoryIten->save();
      return 'iten selled';
    }

    public function delete(InventoryIten $inventoryIten)
    {
      if($inventoryIten->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this iten',400);

      $inventoryIten->delete();
      return 'Invetory iten deleted';
    }
}
