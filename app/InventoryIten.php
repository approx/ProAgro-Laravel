<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Crop;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InventoryIten extends Model
{
    protected $fillable=['name','price','depreciation_time','depreciation_value','farm_id','sold_date','sold_price','currency_id'];

    protected $dates = [
        'created_at',
        'updated_at',
        'sold_date'
    ];

    public function farm()
    {
      return $this->belongsTo('App\Farm');
    }

    public function crops()
    {
      return $this->belongsToMany('App\Crop','crop_inventory_iten');
    }

    public function crops_sold()
    {
      return $this->belongsToMany('App\Crop','inventory_itens_crop');
    }

    public function CalculateSoldValueForCrop($CropId)
    {
      $crops = DB::table('crops')
        ->select('crops.name as crop_name','crops.id as crop_id','fields.area as area')
        ->join('inventory_itens_crop','crops.id','inventory_itens_crop.crop_id')
        ->join('fields','crops.field_id','fields.id')
        ->where('inventory_itens_crop.inventory_iten_id',$this->id)->get();
      $area = 0;
      foreach ($crops as $crop) {
        $area+=$crop->area;
      }
      $crop = Crop::find($CropId);
      return ($crop->field->area/$area)*$this->sold_price;
    }

    public function setSoldDateAttribute($value)
    {
        if($value!=null){
            $this->attributes['sold_date'] = Carbon::createFromFormat('d/m/Y',$value,'America/Sao_Paulo');
        }
    }
}
