<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['city','state','country','street_name','street_number','CEP'];

    public function user()
    {
      return $this->hasOne('App\User');
    }

    public function client()
    {
      return $this->hasOne('App\Client');
    }
}
