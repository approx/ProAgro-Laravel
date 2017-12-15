<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;
use App\Client;

class ClientController extends Controller
{
    public function index()
    {
      return Client::all();
    }

    public function store()
    {
      return Client::create(request()->all());
    }

    public function get(Client $client)
    {
      return $client;
    }

    public function update(Client $client)
    {
      $client->fill(request()->all());
      $client->save();
      return $client;
    }

    public function delete(Client $client)
    {
      $client->delete();
      return 'client deleted';
    }

    public function farms(Client $client)
    {
      return $client->farms;
    }

    public function user(Client $client)
    {
      return $client->user;
    }
}
