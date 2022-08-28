<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RiskCriteria extends Model
{
    //
    //
    protected $table = 'riskcriterias';

    public function simulations(){
        return $this->hasMany('App\Simulation');

    }

    protected $fillable = [
        'has_bank_debt','has_check_returned','has_extraordinary_amt', 'has_something'
    ];

}


