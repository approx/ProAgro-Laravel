<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Culture extends Model
{
    protected $fillable=['name'];

    public function farms()
    {
      return $this->belongsToMany('App\Farm','farm_culture');
    }

    public function crops()
    {
      return $this->hasMany('App\Crop');
    }
}
