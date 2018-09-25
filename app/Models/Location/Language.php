<?php
namespace Models\Location;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $table = 'languages';


}
