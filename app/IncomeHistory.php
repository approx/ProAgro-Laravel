<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeHistory extends Model
{
    protected $fillable = ['farm_id','expense','value','date','description'];

    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];

    public function farm()
    {
      return $this->belongsTo('App\Farm');
    }

    public function activity()
    {
      return $this->hasOne('App\Activity','income_id')->with(['activity_type']);
    }

    public function inventory_iten()
    {
      return $this->hasOne('App\InventoryIten','income_id');
    }

    public function sack_sold()
    {
      return $this->hasOne('App\SackSold','income_id')->with(['crop']);
    }
}
