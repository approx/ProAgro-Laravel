<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryIten extends Model
{
    protected $fillable=['name','price','depreciation_time','depreciation_value','farm_id'];

    public function farm()
    {
      return $this->belongsTo('App\Farm');
    }
}
