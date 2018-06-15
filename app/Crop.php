<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Crop extends Model
{
    protected $fillable = ['field_id','initial_date','final_date','culture_id','name','sack_expected','sack_produced','sack_value','interest_tax','description'];

    protected $dates = [
        'created_at',
        'updated_at',
        'initial_date',
        'final_date'
    ];
    protected $appends = ['gross_income'];

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

    public function inventory_itens_sold()
    {
      return $this->belongsToMany('App\InventoryIten','inventory_itens_crop');
    }

    public function activities()
    {
      return $this->hasMany('App\Activity')->with(['activity_type.group','unity']);
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

    public function getGrossIncomeAttribute()
    {
      // $crops = DB::table('crops')
      //   ->select('crops.name as crop_name','crops.id as crop_id','fields.area as area')
      //   ->join('inventory_itens_crop','crops.id','inventory_itens_crop.crop_id')
      //   ->join('fields','crops.field_id','fields.id')
      //   ->where('inventory_itens_crop.inventory_iten_id',8)->get();
      //
      // return $crops;

      $returnValue=['total'=>0,'history'=>[]];
      foreach ($this->sack_solds as $sack) {
        $total = $sack->quantity*$sack->value;
        array_push($returnValue['history'],['description'=>$sack->quantity.' sacas vendidas','total'=>$total,'currency_id'=>$sack->currency_id,'delete_url'=>'sack_sold/'.$sack->id]);
        $returnValue['total']+=$total;
      }
      foreach ($this->inventory_itens_sold as $iten) {
        $total = $iten->CalculateSoldValueForCrop($this->id);
        array_push($returnValue['history'],['description'=>$iten->name.' vendido','total'=>$total,'currency_id'=>$iten->currency_id]);
        $returnValue['total']+=$total;
      }
      return $returnValue;
    }
}
