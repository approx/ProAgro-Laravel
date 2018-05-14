<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StockHistory;

class Stock extends Model
{
    protected $fillable=['activity_type_id','product_name','quantity','unity_value','farm_id'];
    protected $hidden = ['activity_type_id','farm_id'];

    public function farm()
    {
      return $this->belongsTo('App\Farm');
    }

    public function stock_histories()
    {
      return $this->hasMany('App\StockHistory');
    }

    public function activity_type($value='')
    {
      return $this->belongsTo('App\ActivityType');
    }

    public function AddHistory($quantity)
    {
      $this->quantity+=$quantity;
      StockHistory::create(['stock_id'=>$this->id,'quantity'=>$quantity]);
      $this->save();
    }
}
