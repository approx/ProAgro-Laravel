<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;

class StateController extends Controller
{
    public function index()
    {
      return State::all();
    }

    public function delete(State $state)
    {
      $state->delete();
      return 'State deleted';
    }
}
