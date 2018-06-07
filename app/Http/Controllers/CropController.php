<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Crop;
use App\Field;
use App\SackSold;
use App\IncomeHistory;
use App\Activity;
use App\InventoryIten;
use Illuminate\Support\Facades\Auth;

class CropController extends Controller
{
  public function index()
  {
    $crops = Crop::with(['field.farm','culture','activities','field.farm.client.user:id','inventory_itens','sack_solds'])->get();
    $filtered = $crops->filter(function($value,$key){
      return $value->field->farm->client->user->id === Auth::id() || Auth::user()->role->name=='master' || $value->field->farm->client->client_user == Auth::id();
    });

    return $filtered->values();
  }

  public function store()
  {
    // echo json_encode(request()->final_date);
    $crop =  Crop::create(request()->all());
    if(request()->itens){
      $crop->inventory_itens()->attach(preg_split("/;/",request()->itens));
    }
    // $final_date = Carbon::createFromFormat('Y-m-d', request()->final_date);
    if($crop->final_date->isFuture()){
      $field = Field::find(request()->field_id);
      $field->actual_crop = $crop->id;
      $field->save();
    }
    return $crop;
  }

  public function update_values(Crop $crop)
  {
    request()->validate([
      'interest_tax'=>'required'
    ]);

    $crop->interest_tax = request()->interest_tax;
    $crop->sack_value = request()->sack_value;
    $crop->save();
    return $crop;
  }

  public function update_inventory_itens(Crop $crop)
  {
    request()->validate([
      'inventory_itens'=>'required'
    ]);

    $crop->inventory_itens()->detach();

    $inventoryItens = explode(';',request()->inventory_itens);

    foreach ($inventoryItens as $item) {
      $crop->inventory_itens()->attach($item);
    }

    return 'inventory iten actualized';
  }

  public function get(Crop $crop)
  {
    if($crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master' && $crop->field->farm->client->client_user!=Auth::id()) return response('you dont have access to this crop',400);
    $crop->culture;
    $crop->activities;
    $crop->field->farm->inventory_itens;
    $crop->sack_solds;
    $crop->inventory_itens;
    return $crop;
  }



  public function sumCrops()
  {
    request()->validate([
      'interest_rate'=>'required',
    ]);


    $sumValues=['area'=>0,'production'=>0,'grossIncome'=>0,'activitiesTotal'=>0,'depreciation'=>0,'inventoryTotal'=>0,'capital_tied'=>0,'capital_tied_remunaration'=>0,'activitiesTypes'=>[]];

    $startDate=null;
    $lastDate=null;
    if(!isset(request()->cropsIds)){ return $sumValues; }

    $ids = explode(';',request()->cropsIds);
    foreach ($ids as $id) {
      $crop = Crop::find($id);
      if($startDate==null){
        $startDate = $crop->initial_date;
      }else {
        if($crop->initial_date->lessThan($startDate)){
          $startDate = $crop->initial_date;
        }
      }
      if($lastDate==null){
        $lastDate = $crop->final_date;
      }else {
        if($crop->final_date->greaterThan($lastDate)){
          $lastDate = $crop->final_date;
        }
      }
      $sumValues['area']+=$crop->field->area;
      $sumValues['production']+=$crop->sack_produced;
      $sumValues['grossIncome']+=$crop->gross_income['total'];
      $activities = Activity::where('crop_id',$id)->get();
      foreach ($activities as $acitvity) {
        $sumValues['activitiesTotal']+=$acitvity->total_value;
        $seted=false;
        foreach ($sumValues['activitiesTypes'] as $types) {
          if($types['name']==$acitvity->activity_type->group->name){
            $types['value']+=$acitvity->total_value;
            $seted=true;
            break;
          }
        }
        if($seted==false){
          array_push($sumValues['activitiesTypes'],['name'=>$acitvity->activity_type->group->name,'value'=>$acitvity->total_value]);
        }
      }
      // $sumValues['activitiesTotal']+=Activity::where('crop_id',$id)->sum('total_value');

      $inventoryItenSum = 0;
      foreach ($crop->inventory_itens as $iten) {
        $inventoryItenSum+=$iten->depreciation_value;
        $sumValues['inventoryTotal']+=$iten->price;
      }
      $sumValues['depreciation']+=$inventoryItenSum;
    }
    $lastDate = $lastDate->min(new Carbon());
    $diffMonths = $startDate->diffInMonths($lastDate);
    $sumValues['depreciation']*=$diffMonths;
    $sumValues['capital_tied'] = $crop->field->farm->capital_tied;
    $sumValues['capital_tied_remunaration'] = ($crop->field->farm->capital_tied*request()->interest_rate)*$diffMonths;

    return $sumValues;
  }

  public function register_sack(Crop $crop)
  {
    if($crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this crop',400);
    $sackSold = SackSold::create(['crop_id'=>$crop->id,'quantity'=>request()->quantity,'value'=>request()->value]);
    return $sackSold;
  }

  public function update(Crop $crop)
  {
    if($crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this crop',400);

    $crop->fill(request()->all());
    $crop->save();
    return $crop;
  }

  public function delete(Crop $crop)
  {
    if($crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') return response('you dont have access to this crop',400);

    $crop->delete();
    return 'crop deleted';
  }
}
