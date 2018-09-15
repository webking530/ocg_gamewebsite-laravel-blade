<?php

namespace App\Models\Gaming;

use Illuminate\Database\Eloquent\Model;
use Models\Auth\User;

class Badge extends Model
{
    protected $guarded = ['id'];

    public function users() {
        return $this->belongsToMany(User::class, 'badge_user', 'badge_id', 'user_id');
    }
}
