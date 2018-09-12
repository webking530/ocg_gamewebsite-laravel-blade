<?php

namespace App\Models\Pricing;

use Illuminate\Database\Eloquent\Model;

class Deposits extends Model
{
     public function user(){

    	return $this->belongsTo('App\Models\User','user_id');
    	
    }
    public function currency()
    {
    	return $this->belongsTo('App\Models\Pricing\Currency','currency_code');
    }
}
