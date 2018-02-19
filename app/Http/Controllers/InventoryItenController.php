<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InventoryIten;
use Illuminate\Support\Facades\Auth;

class InventoryItenController extends Controller
{
    public function index()
    {
      $itens = InventoryIten::with('farm.client.user:id')->orderBy('name')->get();

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
      if($inventoryIten->sold_price&&$inventoryIten->sold_date){
        $inventoryIten->sold = true;
      }
      $inventoryIten->save();
      return $inventoryIten;
    }

    public function delete(InventoryIten $inventoryIten)
    {
      if($inventoryIten->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this iten',400);

      $inventoryIten->delete();
      return 'Invetory iten deleted';
    }
}
