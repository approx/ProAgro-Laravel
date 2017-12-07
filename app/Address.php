<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function user()
    {
      return $this->hasOne('App\User');
    }

    public function city()
    {
      return $this->belongsTo('App\City');
    }

    public function client()
    {
      return $this->hasOne('App\Client');
    }

    public function farm()
    {
      return $this->hasOne('App\Farm');
    }
}
