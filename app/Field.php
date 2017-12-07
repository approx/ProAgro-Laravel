<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public function actual_crop()//possivel erro por causa do nome
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
