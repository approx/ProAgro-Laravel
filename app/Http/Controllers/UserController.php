<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function index()
  {
    if(Auth::user()->role->name!='master') return response('you dont have access to this',400);
    return User::all();
  }

  public function store()
  {
    if(Auth::user()->role->name!='master') return response('you dont have access to this',400);
    return User::create(request()->all());
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
