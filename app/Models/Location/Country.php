<?php

namespace Models\Location;

use Illuminate\Database\Eloquent\Model;
use Models\Pricing\Currency;
use Models\Pricing\HasCurrency;
use Illuminate\Support\Facades\DB;

class Country extends Model {

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

    public function user() {
        return $this->hasMany(\Models\Auth\User::class, 'country_code');
    }

    public function scopeEnabled($query) {
        return $query->whereEnabled(1);
    }

    public function pricingCurrency() {
        return $this->belongsTo(Currency::class, 'pricing_currency');
    }

    public function getNameAttribute() {
        return country_name($this->attributes['code']);
    }

    public function getFlagIconAttribute() {
        return "img/flags/" . mb_strtolower($this->code) . ".png";
    }

    public function getDepositsByCountry(Country $country) {
        $deposite = \Models\Pricing\Deposit::select(DB::raw('sum(amount_USD) as countrydepossite'))
                        ->where('currency_code', $country->currency_code)->first();
        return ($deposite->countrydepossite) != null ? $deposite->countrydepossite : 0;
    }

    public static function getDefaultCountryCode() {
        return 'DE';
    }

}
