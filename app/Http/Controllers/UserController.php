<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
  public function index()
  {
    return User::all();
  }

  public function store()
  {
    return User::create(request()->all());
  }

  public function get(User $user)
  {
    return $user;
  }

  public function update(User $user)
  {
    $user->fill(request()->all());
    $user->save();
    return $user;
  }

  public function delete(User $user)
  {
    $user->delete();
    return 'user deleted';
  }

  public function role(User $user)
  {
    return $user->role;
  }

  public function address(User $user)
  {
    return $user->address;
  }

  public function clients(User $user)
  {
    return $user->clients;
  }
}
