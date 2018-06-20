<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropagateActivity extends Model
{
      protected $fillable=['farm_id','activities_ids','total_value'];
}
