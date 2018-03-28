<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Roles;

class RolesController extends Controller
{
    public function index()
    {
      return Roles::all();
    }
}
