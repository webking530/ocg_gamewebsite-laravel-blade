<?php
namespace Models\Pricing;

trait HasCurrency
{
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_code');
    }
}