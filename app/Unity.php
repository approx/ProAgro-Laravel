<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unity extends Model
{
  protected $fillable= ['id','name'];
  protected $primaryKey = 'id';
  public $incrementing = false;

    public function activities()
    {
      return $this->hasMany('App\Activity');
    }
}
