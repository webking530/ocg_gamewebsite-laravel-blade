<?php

namespace Models\Gaming;

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
        return $this->belongsToMany(User::class, 'tournament_user', 'tournament_id', 'user_id')->withPivot(['total_win']);
    }

    public function getFormattedGroupAttribute() {
        return trans('games.group.' . $this->group);
    }
}
