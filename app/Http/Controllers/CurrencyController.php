<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
      return Currency::all();
    }
}
