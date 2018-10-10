<?php namespace Models\Location;

use Illuminate\Database\Eloquent\Model;
use Models\Pricing\Currency;
use Models\Pricing\HasCurrency;

class Country extends Model
{
    use HasCurrency;
    use HasLanguage;

    protected $primaryKey = 'code';
    public $incrementing = false;
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function scopeEnabled($query)
    {
        return $query->whereEnabled(1);
    }


    public function pricingCurrency() {
        return $this->belongsTo(Currency::class, 'pricing_currency');
    }

    public function getNameAttribute()
    {
        return country_name($this->attributes['code']);
    }

}
