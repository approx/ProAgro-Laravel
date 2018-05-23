<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryIten extends Model
{
    protected $fillable=['name','price','depreciation_time','depreciation_value','farm_id','sold_date','sold_price','currency_id'];

    protected $dates = [
        'created_at',
        'updated_at',
        'sold_date'
    ];

    public function farm()
    {
      return $this->belongsTo('App\Farm');
    }

    public function crops()
    {
      return $this->belongsTo('App\Crop','crop_inventory_iten');
    }

    public function income()
    {
      return $this->belongsTo('App\IncomeHistory','income_id');
    }
}
