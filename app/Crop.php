<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    public function field()
    {
      return $this->belongsTo('App\Field');
    }

    public function culture()
    {
      return $this->belongsTo('App\Culture');
    }

    public function activities()
    {
      return $this->hasMany('App\Activity');
    }
}
