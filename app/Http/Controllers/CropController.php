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
use App\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CropController extends Controller
{
    public function index()
    {
        $crops = Crop::with(['field.farm','culture','activities','field.farm.client.user:id','inventory_itens','sack_solds'])->get();
        $filtered = $crops->filter(function ($value, $key) {
            return $value->field->farm->client->user->id === Auth::id() || Auth::user()->role->name=='master' || $value->field->farm->client->client_user == Auth::id();
        });

        return $filtered->values();
    }

    public function store()
    {
        $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/crops','action'=>'create','request'=>request()->getContent()]);
        // echo json_encode(request()->final_date);
        $crop =  Crop::create(request()->all());
        if (request()->itens) {
            $crop->inventory_itens()->attach(preg_split("/;/", request()->itens));
        }
        // $final_date = Carbon::createFromFormat('Y-m-d', request()->final_date);
        if ($crop->final_date->isFuture()) {
            $field = Field::find(request()->field_id);
            $field->actual_crop = $crop->id;
            $field->save();
        }
        $log->done();
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

    public function addDescription(Crop $crop)
    {
        $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/crop/'.$crop->id.'/add_description','action'=>'update','request'=>request()->getContent()]);
        request()->validate([
      'description'=>'required'
    ]);

        $crop->description=request()->description;
        $crop->save();
        $log->done();
        return $crop;
    }

    public function update_inventory_itens(Crop $crop)
    {
        $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/crop/'.$crop->id.'/update_inventory_itens','action'=>'update','request'=>request()->getContent()]);
        request()->validate([
      'inventory_itens'=>'required'
    ]);

        $crop->inventory_itens()->detach();

        $inventoryItens = explode(';', request()->inventory_itens);

        foreach ($inventoryItens as $item) {
            $crop->inventory_itens()->attach($item);
        }
        $log->done();
        return 'inventory iten actualized';
    }

    public function get(Crop $crop)
    {
        if ($crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master' && $crop->field->farm->client->client_user!=Auth::id()) {
            return response('you dont have access to this crop', 400);
        }
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


        $sumValues=['area'=>0,'production'=>0,'grossIncome'=>0,'activitiesTotal'=>0,'depreciation'=>0,'totalDepreciation'=>0,'inventoryTotal'=>0,'capital_tied'=>0,'capital_tied_remunaration'=>0,'activitiesTypes'=>[]];

        $startDate=null;
        $lastDate=null;
        if (!isset(request()->cropsIds)) {
            return $sumValues;
        }

        $ids = explode(';', request()->cropsIds);

        if (count($ids) > 0) {
            $in = str_repeat('?,', count($ids)-1) . '?';

            $results = DB::select(DB::raw("select
            	sum(f.area) as sum_area, sum(c.sack_produced) as sum_production, f.farm_id
            from
            	proprodu_proagro.crops c
            	inner join proprodu_proagro.fields f on c.field_id = f.id
            where
            	c.id in (" . $in . ") group by f.farm_id;"), $ids);

            if (count($results) > 0) {
                $sumValues['area'] = $results[0]->sum_area;
                $sumValues['production'] = $results[0]->sum_production;
                $farm_id = $results[0]->farm_id;
            }

            // Calcular o valor total arrecadado com as vendas das sacas
            $results = DB::select(DB::raw("select
            	sum(s.value * s.quantity) as total
            from
            	sack_solds s
            where
                s.crop_id in (" . $in . ");"), $ids);

            if (count($results) > 0) {
                $sumValues['grossIncome'] = $results[0]->total;
            }

            // Falta calcular o valor total arrecadado com as vendas do inventário. Crop.php 77-81
            //$sumValues['grossIncome'] = valro_inventario_vendido;

            $results = DB::select(DB::raw("select
            	sum(total_value) as total_value, g.name as group_name, g.id
            from
                activities a
                inner join activity_types t on a.activity_type_id = t.id
                inner join group_activities g on t.group_id = g.id
            where
                crop_id in (" . $in . ") group by g.id, g.name;"), $ids);

            foreach ($results as $acitvity) {
                array_push($sumValues['activitiesTypes'], ['name'=>$acitvity->group_name,'value'=>$acitvity->total_value]);
            }

            $results = DB::select(DB::raw("select
            	sum(i.price) as sum_price, sum(i.depreciation_value * (f.area/ (select sum(area) from fields where farm_id = '" . $farm_id . "') )) as sum_inventory_item
            from
            	crops c
                inner join crop_inventory_iten ci on c.id = ci.crop_id
                inner join inventory_itens i on ci.inventory_iten_id = i.id
                inner join fields f on c.field_id = f.id
            where
            	crop_id in (" . $in . ");"), $ids);

            if (count($results) > 0) {
                $sumValues['inventoryTotal'] = $results[0]->sum_price;
                $sumValues['depreciation'] = $results[0]->sum_inventory_item;
            }
        }

        foreach ($ids as $id) {
            $crop = Crop::find($id);
            if ($startDate==null) {
                $startDate = $crop->initial_date;
            } else {
                if ($crop->initial_date->lessThan($startDate)) {
                    $startDate = $crop->initial_date;
                }
            }
            if ($lastDate==null) {
                $lastDate = $crop->final_date;
            } else {
                if ($crop->final_date->greaterThan($lastDate)) {
                    $lastDate = $crop->final_date;
                }
            }
            //$sumValues['area']+=$crop->field->area;
            //$sumValues['production']+=$crop->sack_produced;
            //$sumValues['grossIncome']+=$crop->gross_income['total'];
            /*$activities = Activity::where('crop_id', $id)->get();
            foreach ($activities as $acitvity) {
                $sumValues['activitiesTotal']+=$acitvity->total_value;
                $seted=false;
                foreach ($sumValues['activitiesTypes'] as $types) {
                    if ($types['name']==$acitvity->activity_type->group->name) {
                        $types['value']+=$acitvity->total_value;
                        $seted=true;
                        break;
                    }
                }
                if ($seted==false) {
                    array_push($sumValues['activitiesTypes'], ['name'=>$acitvity->activity_type->group->name,'value'=>$acitvity->total_value]);
                }
            }*/
            // $sumValues['activitiesTotal']+=Activity::where('crop_id',$id)->sum('total_value');

            /*$inventoryItenSum = 0;
            // dd($crop->inventory_itens);
            foreach ($crop->inventory_itens as $iten) {
                $inventoryItenSum+=$iten->depreciation_value*($crop->field->area/$crop->field->farm->area_planted);
                $sumValues['inventoryTotal']+=$iten->price;
            }
            $sumValues['depreciation']+=$inventoryItenSum;*/
        }
        $lastDate = $lastDate->min(new Carbon());
        $diffMonths = $startDate->diffInMonths($lastDate);
        $sumValues['totalDepreciation']+=$sumValues['depreciation']*$diffMonths;
        // dd($inventoryItenSum);
        // $sumValues['depreciation']*=$diffMonths;
        $sumValues['capital_tied'] = $crop->field->farm->capital_tied;
        $sumValues['remunaration'] = ($crop->field->farm->capital_tied*request()->interest_rate)/100;
        $sumValues['totalRemunaration'] = $sumValues['remunaration']*$diffMonths;

        return $sumValues;
    }

    public function register_sack(Crop $crop)
    {
        $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/crop/'.$crop->id.'/sold_sack','action'=>'create','request'=>request()->getContent()]);
        if ($crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') {
            return response('you dont have access to this crop', 400);
        }
        $sackSold = SackSold::create(['crop_id'=>$crop->id,'quantity'=>request()->quantity,'value'=>request()->value]);
        $log->done();
        return $sackSold;
    }

    public function update(Crop $crop)
    {
        $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/crop/'.$crop->id,'action'=>'update','request'=>request()->getContent()]);
        if ($crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') {
            return response('you dont have access to this crop', 400);
        }

        $crop->fill(request()->all());
        $crop->save();
        $log->done();
        return $crop;
    }

    public function delete(Crop $crop)
    {
        $log = Log::create(['user_name'=>Auth::user()->name,'user_id'=>Auth::user()->id,'route'=>'/crop/'.$crop->id,'action'=>'delete','request'=>request()->getContent()]);
        if ($crop->field->farm->client->user->id!=Auth::id() && Auth::user()->role->name!='master') {
            return response('you dont have access to this crop', 400);
        }

        $crop->delete();
        $log->done();
        return 'crop deleted';
    }
}
