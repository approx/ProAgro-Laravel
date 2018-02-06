<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Crop extends Model
{
    protected $fillable = ['field_id','initial_date','final_date','culture_id','name','expected','sack'];

    protected $dates = [
        'created_at',
        'updated_at',
        'initial_date',
        'final_date'
    ];

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
      return $this->hasMany('App\Activity')->with(['activity_type','unity']);
    }

    // public function boot()
    // {
    //     Carbon::serializeUsing(function ($carbon) {
    //         return $carbon->format('U');
    //     });
    // }

    // public function setInitialDateAttribute($value)
    // {
    //   $this->attributes['initial_date'] = Carbon::createFromFormat('Y-m-d', $value);
    //   echo $value;
    // }
    //
    // public function setFinalDateAttribute($value)
    // {
    //   $this->attributes['final_date'] = Carbon::createFromFormat('Y-m-d', $value);
    //   echo $value;
    // }
    //
    // public function getInitialDateAttribute($value)
    // {
    //   return $value->toDateString();
    // }
    //
    // public function getFinalDateAttribute($value)
    // {
    //   return $value->toDateString();
    // }
}
