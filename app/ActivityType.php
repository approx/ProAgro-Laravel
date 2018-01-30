<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    protected $fillable= ['id','name','unity_value'];
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function activities()
    {
      return $this->hasMany('App\Activity');
    }
}
