<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncomeHistory extends Model
{
    protected $fillable = ['farm_id','expense','value','date','description'];

    protected $dates = [
        'created_at',
        'updated_at',
        'date'
    ];
}
