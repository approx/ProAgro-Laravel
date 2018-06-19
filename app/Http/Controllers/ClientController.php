<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Database\QueryException;
use App\Client;
use Illuminate\Support\Facades\Auth;
use App\Log;

class ClientController extends Controller
{
    public function index()
    {
      if(Auth::user()->role->name=='master') return Client::with(['farms','address','user.role'])->get();

      return Client::with(['farms','address','user:id,name'])->where('user_id',Auth::id())->orWhere('client_user',Auth::id())->get();
    }

    public function store()
    {
      $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/clients','action'=>'create','request'=>request()->getContent()]);
      $client = Client::create(request()->all());
      $log->done();
      return $client;
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
      $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/client/'.$client->id,'action'=>'update','request'=>request()->getContent()]);
      $client->user;
      if($client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this client',400);
      $client->fill(request()->all());
      $client->save();
      $log->done();
      return $client;
    }

    public function delete(Client $client)
    {
      $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/client/'.$client->id,'action'=>'delete','request'=>request()->getContent()]);
      $client->user;
      if($client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this client',400);
      $client->delete();
      $log->done();
      return 'client deleted';
    }
}
