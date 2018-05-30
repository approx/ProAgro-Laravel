<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    protected $fillable= ['id','name','unity_id'];
    protected $primaryKey = 'id';
    public $incrementing = false;

    public function activities()
    {
      return $this->hasMany('App\Activity');
    }

    public function unity()
    {
      return $this->belongsTo('App\Unity');
    }

    public function group()
    {
      return $this->belongsTo('App\Group_activity','group_id');
    }
}
