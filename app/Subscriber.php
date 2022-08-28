<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    //

    public function simulations(){
        return $this->hasMany('App\Simulation');

    }

    protected $fillable = [
        'sub_name','sub_doc_id','sub_vendor','sub_agent','sub_account_type',
        'sub_contract_no'
    ];

}
