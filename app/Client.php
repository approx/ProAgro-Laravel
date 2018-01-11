<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name','state_id','email','phone','phone_2','inscription_number','cpf_cnpj','address_id','user_id'];
    protected $hidden =['state_id','user_id','address_id'];

    public function farms()
    {
      return $this->hasMany('App\Farm');
    }

    public function address()
    {
      return $this->belongsTo('App\Address');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
