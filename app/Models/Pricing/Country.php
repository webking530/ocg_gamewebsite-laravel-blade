<?php
namespace App\Models\Pricing;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $table = 'countries';


   
}
