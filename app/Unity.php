<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unity extends Model
{
    public function activities()
    {
      return $this->hasMany('App\Activity');
    }
}
