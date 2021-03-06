<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\GiveAcessUser;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Token;
use App\UserToken;
use App\Client;
use App\Address;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function index()
  {
    if(Auth::user()->role->name!='master') return response('you dont have access to this',400);
    return User::all();
  }

  public function access()
  {
    request()->validate([
      'name'=>'required|max:40',
      'email'=>'required|email',
      'role_id'=>'required|numeric',
      'client_id'=>'numeric'
    ]);

    $name = request()->name;
    $email = request()->email;
    $role_id = request()->role_id;
    $url = request()->url;
    $client_id = request()->client_id;
    if ($client_id == '') {
      $client_id = 0;
    }

    $token = UserToken::create(['name'=>$name,'email'=>$email,'role_id'=>$role_id,'client_id'=>$client_id]);
    Mail::to($email)->send(new GiveAcessUser($name,$token->token,$url),$token->token);
    if (count(Mail::failures()) > 0) {
        return Mail::failures();
    }

    return response("Acess Email Sended",200);
  }

  public function register()
  {

    request()->validate([
      'password'=>'required|confirmed',
      'CPF'=>'required|size:11',
      'phone'=>'required|min:10|max:11',
      'token'=>'required|exists:user_tokens'
    ]);
    $token = UserToken::where('token','=',request()->token)->first();

    $user = User::create(request()->all()+['name'=>$token->name,'role_id'=>$token->role_id,'email'=>$token->email]);

    if ($token->client_id > 0) {
      $client = Client::find($token->client_id);
      $client->client_user = $user->id;
      $client->save();
    } else {
      return $token;
    }

    $token->delete();

    return $user;
  }

  public function get(User $user)
  {
    if(Auth::user()->role->name!='master') return response('you dont have access to this',400);
    return $user;
  }

  public function actualUser()
  {
    $user = Auth::user();
    $user->role;
    return $user;
  }

  public function update(User $user)
  {
    if(Auth::user()->role->name!='master' && $user->id!=Auth::id()) return response('you dont have access to this',400);
    $user->fill(request()->all());
    $user->save();
    return $user;
  }

  public function delete(User $user)
  {
    if(Auth::user()->role->name!='master') return response('you dont have access to this',400);
    $user->delete();
    return 'user deleted';
  }
}
