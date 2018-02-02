<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InventoryIten;

class InventoryItenController extends Controller
{
    public function index()
    {
      return InventoryIten::with('farm')->orderBy('name')->get();
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
