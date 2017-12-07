<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    public function farms()
    {
      return $this->belongsToMany('App\Farm');
    }

    public function crops()
    {
      return $this->hasMany('App\Crop');
    }
}
