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
        return $value->farm->client->user->id === Auth::id();
      });

      return $filtered->values();
    }

    public function store()
    {
      return InventoryIten::create(request()->all());
    }

    public function get(InventoryIten $inventoryIten)
    {
      return $inventoryIten;
    }

    public function update(InventoryIten $inventoryIten)
    {
      $inventoryIten->fill(request()->all());
      $inventoryIten->save();
      return $farm;
    }

    public function delete(InventoryIten $inventoryIten)
    {
      $inventoryIten->delete();
      return 'Invetory iten deleted';
    }
}
