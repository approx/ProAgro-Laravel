<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $fillable=['stock_id','quantity'];

    public function stock()
    {
      return $this->belongsTo('App\Stock');
    }
}
