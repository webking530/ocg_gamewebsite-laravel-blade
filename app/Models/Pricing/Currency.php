<?php
namespace App\Models\Pricing;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $table = 'currencies';

    public function getFormattedCodeAttribute() {
        return "{$this->code} ({$this->symbol})";
    }

    public function fromExchanges()
    {
        return $this->hasMany(Currency::class, 'from');
    }

    public function toExchanges()
    {
        return $this->hasMany(Currency::class, 'to');
    }

    public function countries() {
        return $this->hasMany(Country::class, 'currency_code');
    }

    public function countriesPricing() {
        return $this->hasMany(Country::class, 'pricing_currency');
    }
}
