<?php

namespace Models\News;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $guarded = ['id'];

    protected $dates = [
        'date_from',
        'date_to'
    ];

    public function scopeCurrentNews($query) {
        $now = Carbon::now();

        return $query->where('date_from', '<=', $now)->where('date_to', '>=', $now);
    }
}
