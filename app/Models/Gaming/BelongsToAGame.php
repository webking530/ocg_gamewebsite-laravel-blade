<?php namespace Models\Gaming;


trait BelongsToAGame
{

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id');
    }
}