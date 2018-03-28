<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserToken;

class UserTokenController extends Controller
{
    public function valid($userToken)
    {
      $token = UserToken::where('token',"=",$userToken)->first();
      if($token){
        return $token;
      }
      return response("token is not valid",404);
    }
}
