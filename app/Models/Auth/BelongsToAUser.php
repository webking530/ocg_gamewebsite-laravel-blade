<?php namespace Models\Auth;


trait BelongsToAUser
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}