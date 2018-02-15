<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $fillable=['name','lat', 'lng','client_id','ha','value_ha','capital_tied','remuneration'];

    protected $hidden = ['client_id'];

    public function fields()
    {
      return $this->hasMany('App\Field');
    }

    public function inventory_itens()
    {
      return $this->hasMany('App\InventoryIten');
    }rn $this->belongsTo('App\Address');
    }

    public function client()
    {
      return $this->belongsTo('App\Client');
    }

    public function cultures()
    {
      return $this->belongsToMany('App\Culture','farm_culture');
    }
}
