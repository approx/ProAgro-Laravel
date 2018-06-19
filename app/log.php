<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['user_name','user_id','route','action','request','error'];

    public function done()
    {
      $this->error = false;
      $this->save();
    }
}
