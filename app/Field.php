<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = ['actual_crop','name','area','lat','lng','farm_id','field_type_id'];
    protected $hidden = ['farm_id','actual_crop'];

    public function crop()
    {
      return $this->belongsTo('App\Crop','actual_crop')->with('field.farm');
    }

    public function crops()
    {
      return $this->hasMany('App\Crop')->with('field.farm');
    }

    public function farm()
    {
      return $this->belongsTo('App\Farm');
    }

    public function field_type()
    {
      return $this->belongsTo('App\FieldType');
    }
}
