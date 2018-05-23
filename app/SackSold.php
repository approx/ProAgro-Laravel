<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SackSold extends Model
{
    protected $fillable=['crop_id','value','quantity','currency_id'];

    public function crop()
    {
      return $this->belongsTo('App\Crop');
    }

    public function income()
    {
      return $this->belongsTo('App\IncomeHistory','income_id');
    }
}
