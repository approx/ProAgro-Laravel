<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;
use App\Client;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index()
    {
      if(Auth::user()->role->name=='master') return Client::with(['farms','address','user.role'])->get();

      return Client::with(['farms','address','user:id,name'])->where('user_id',Auth::id())->orWhere('client_user',Auth::id())->get();
    }

    public function store()
    {
      return Client::create(request()->all());
    }

    public function get(Client $client)
    {
      $client->user;
      if($client->user->id!=Auth::id() && Auth::user()->role->name!='master' && $client->client_user!=Auth::id()) return response('you dont have access to this client',400);
      $client->farms;
      $client->address;
      return $client;
    }

    public function update(Client $client)
    {
      $client->user;
      if($client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this client',400);
      $client->fill(request()->all());
      $client->save();
      return $client;
    }

    public function delete(Client $client)
    {
      $client->user;
      if($client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this client',400);
      $client->delete();
      return 'client deleted';
    }
}
