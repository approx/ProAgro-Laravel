<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    public function fields()
    {
      return $this->hasMany('App\Farm');
    }

    public function address()
    {
      return $this->belongsTo('App\Address');
    }

    public function client()
    {
      return $this->belongsTo('App\Client');
    }

    public function cultures()
    {
      return $this->belongsToMany('App\Culture');
    }
}
