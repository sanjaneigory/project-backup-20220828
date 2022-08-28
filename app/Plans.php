<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    //

    public function simulations(){
        return $this->hasMany('App\Simulation');

    }

    protected $fillable = [
        'plan_name','plan_price','plan_deposit','plan_cib','plan_services','plan_type'
    ];
}
