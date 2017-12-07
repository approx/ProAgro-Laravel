<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    public function activity_type()
    {
      return $this->belongsTo('App\Activity');
    }

    public function crop()
    {
      return $this->belongsTo('App\Crop');
    }

    public function unity()
    {
      return $this->belongsTo('App\Unity');
    }
}
