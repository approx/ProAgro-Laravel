<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable=['activity_type_id','quantity','unity_value','total_value','farm_id'];

    public function farm()
    {
      return $this->belongsTo('App\Farm');
    }
}
