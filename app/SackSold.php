<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SackSold extends Model
{
    protected $fillable=['crop_id','value','quantity'];

    public function crop()
    {
      return $this->belongsTo('App\Crop');
    }
}