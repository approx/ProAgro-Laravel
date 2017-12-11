<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

  protected $fillable = ['operation_date','payment_date','activity_type_id','total_value','quantity','unity_id','dose','crop_id'];

    public function activity_type()
    {
      return $this->belongsTo('App\ActivityType');
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
