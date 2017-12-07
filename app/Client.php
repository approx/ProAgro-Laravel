<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function farms()
    {
      return $this->hasMany('App\Farm');
    }

    public function address()
    {
      return $this->belongsTo('App\Address');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
