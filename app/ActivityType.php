<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    protected $fillable= ['name','unity_value','value_per_ha'];

    public function activities()
    {
      return $this->hasMany('App\Activity');
    }
}
