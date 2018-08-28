<?php
namespace Models\Pricing;


use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $primaryKey = ['from', 'to'];
    public $incrementing = false;
    protected $table = 'exchange';
    protected $guarded = [
        'rate'
    ];

    public function fromCurrency() {
        return $this->belongsTo(Currency::class, 'from');
    }

    public function toCurrency() {
        return $this->belongsTo(Currency::class, 'to');
    }
}
