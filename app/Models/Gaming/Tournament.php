<?php

namespace Models\Gaming;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Models\Auth\User;

class Tournament extends Model
{
    protected $table = 'tournaments';
    protected $guarded = ['id'];

    protected $dates = [
        'date_from',
        'date_to'
    ];

    protected $casts = [
        'prizes' => 'array'
    ];

    public function games() {
        return $this->belongsToMany(Game::class, 'tournament_game', 'tournament_id', 'game_id');
    }

    public function users() {
        return $this->belongsToMany(User::class, 'tournament_user', 'tournament_id', 'user_id')->withPivot(['total_win'])->orderBy('pivot_total_win', 'DESC');
    }

    public function getFormattedGroupAttribute() {
        return trans('games.group.' . $this->group);
    }

    public function scopeFinished($query) {
        return $query->where('date_to', '<', Carbon::now());
    }

    public function scopeActive($query) {
        $now = Carbon::now();

        return $query->where('date_from', '<=', $now)->where('date_to', '>=', $now);
    }

    public function getDurationInDays() {
        return $this->date_to->diffInDays($this->date_from);
    }
}
