<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Simulation extends Model
{
    //

    protected $table = 'simulations';


    //Handling subscriber relationships
    public function subscriber(){
        return $this->belongsTo('App\Subscriber');
    }


    public function subscribers(){
        return $this->belongsTo('App\Subscriber', 'subscriber_id');
    }

    //handling risk criterias relationships
    public function riskcriteria(){
        return $this->belongsTo('App\RiskCriteria');
    }


    public function riskcriterias(){
        return $this->belongsTo('App\RiskCriteria', 'riskcriteria_id');
    }

    //handling plans relationships
    public function plan(){
        return $this->belongsTo('App\Plans');
    }


    public function plans(){
        return $this->belongsTo('App\Plans', 'plan_id');
    }




    protected $fillable = [
        'sim_bank_acc_no','sim_bank_bal_1','sim_bank_bal_2','sim_bank_bal_3','sim_recommendation',
        'sim_result', 'sim_overide', 'sim_status'
    ];
}
