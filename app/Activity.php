<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

  protected $fillable = ['operation_date','payment_date','activity_type_id','total_value','quantity','value_per_ha','unity_id','dose','crop_id','product_name'];

  protected $dates = [
      'created_at',
      'updated_at',
      'operation_date',
      'payment_date'
  ];

    public function activity_type()
    {
      return $this->belongsTo('App\ActivityType');
    }

    public function income()
    {
      return $this->belongsTo('App\IncomeHistory','income_id');
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
