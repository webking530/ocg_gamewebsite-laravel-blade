<?php

namespace Models\Gaming;

use Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $guarded = ['id'];

    public function users() {
        return $this->belongsToMany(User::class, 'badge_user', 'badge_id', 'user_id');
    }
}
