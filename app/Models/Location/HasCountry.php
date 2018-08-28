<?php
namespace Models\Location;

trait HasCountry
{
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'code');
    }
}