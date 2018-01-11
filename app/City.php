<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $hidden = ['state_id'];
    public function state()
    {
      return $this->belongsTo('App\State');
    }

    public function addresses()
    {
      return $this->hasMany('App\Address');
    }
}
