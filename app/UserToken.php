<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    public $fillable=['name','token','email','role_id'];
    public $hidden=['role_id'];


    public static function create($properties){
      if(!array_key_exists("token", $properties)){
        $properties["token"] = UserToken::GetUniqueToken();
      }
      return static::query()->create($properties);
    }

    public static function GetUniqueToken(){
      $token;
      do {
        $token = str_random(80);
      } while (UserToken::where("token","=",$token)->first()!=null);
      return $token;
    }
}
