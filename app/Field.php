<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = ['actual_crop','name','area','lat','lng','farm_id'];

    public function crop()
    {
      return $this->belongsTo('App\Crop','actual_crop');
    }

    public function crops()
    {
      return $this->hasMany('App\Crop');
    }

    public function farm()
    {
      return $this->belongsTo('App\Farm');
    }
}
