<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;

class AddressController extends Controller
{
    public function index()
    {
      return Address::all();
    }

    public function store()
    {
      return Address::create(request()->all());
    }

    public function get(Address $address)
    {
      return $address;
    }

    public function update(Address $address)
    {
      $address->fill(request()->all());
      $address->save();
      return $address;
    }

    public function delete(Address $address)
    {
      $address->delete();
      return 'Address deleted';
    }
}
