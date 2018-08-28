<?php

namespace App\Models\Gaming;

use Illuminate\Database\Eloquent\Model;
use Models\Location\HasCountry;

class Lottery extends Model
{
    use HasCountry;

    protected $guarded = ['id'];
    protected $dates = [
        'date_open',
        'date_close',
        'date_begin'
    ];
}
