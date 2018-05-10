<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    protected $fillable=['name','lat', 'lng','client_id','ha','value_ha','capital_tied','income','remuneration'];

    protected $hidden = ['client_id'];

    public function fields()
    {
      return $this->hasMany('App\Field');
    }

    public function stocks()
    {
      return $this->hasMany('App\Stock')->with(['stock_histories','activity_type']);
    }

    public function CalculateIncome()
    {
      $this->income = 0;
      foreach ($this->income_histories as $iten) {
        if($iten->expense){
          $this->income-= $iten->value;
        }
        else {
          $this->income+= $iten->value;
        }
      }
      $this->save();
    }

    public function PlantedArea(){
      $fields = $this->fields;
      $area = 0;
      foreach ($fields as $field) {
        if($field->crop){
          $area+=$field->area;
        }
      }
      return $area;
    }

    public function FieldAreas(){
      $fields = $this->fields;
      $area = 0;
      foreach ($fields as $field) {
        $area+=$field->area;
      }
      return $area;
    }

    public function income_histories()
    {
      return $this->hasMany('App\IncomeHistory')->with(['activity','inventory_iten','sack_sold']);
    }

    public function inventory_itens()
    {
      return $this->hasMany('App\InventoryIten')->where('sold',false);
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
