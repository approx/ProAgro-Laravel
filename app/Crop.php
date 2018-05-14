<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Crop extends Model
{
    protected $fillable = ['field_id','initial_date','final_date','culture_id','name','sack_expected','sack_produced'];

    protected $dates = [
        'created_at',
        'updated_at',
        'initial_date',
        'final_date'
    ];

    public function field()
    {
      return $this->belongsTo('App\Field');
    }

    public function culture()
    {
      return $this->belongsTo('App\Culture');
    }

    public function sack_solds()
    {
      return $this->hasMany('App\SackSold');
    }

    public function activities()
    {
      return $this->hasMany('App\Activity')->with(['activity_type','unity']);
    }

    public function inventory_itens()
    {
      return $this->belongsToMany('App\InventoryIten','crop_inventory_iten');
    }

    public function setInitialDateAttribute($value)
    {
      $this->attributes['initial_date'] = Carbon::createFromFormat('d/m/Y',$value,'America/Sao_Paulo');
    }

    public function setFinalDateAttribute($value)
    {
      $this->attributes['final_date'] = Carbon::createFromFormat('d/m/Y',$value,'America/Sao_Paulo');
    }
}
