<?php

use Models\Bonuses\Bonus;
use Illuminate\Database\Seeder;

class BonusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bonus::create([
            'name' => 'Welcome Bonus',
            'slug' => 'welcome',
            'description' => 'Sign up and get some free credits!',
            'type' => Bonus::TYPE_CREDITS,
            'prize' => 10
        ]);

        Bonus::create([
            'name' => 'Slot Bonus',
            'slug' => 'slot',
            'description' => 'Play on all slot machine games and get some bonus credits!',
            'type' => Bonus::TYPE_CREDITS,
            'prize' => 25
        ]);
        Bonus::create([
            'name' => 'Casino Bonus',
            'slug' => 'casino',
            'description' => 'Play on all card games and get some bonus credits!',
            'type' => Bonus::TYPE_CREDITS,
            'prize' => 25
        ]);
        Bonus::create([
            'name' => 'Christmas Bonus',
            'slug' => 'christmas',
            'description' => 'Get an extra % for all your deposits on Christmas Eve',
            'type' => Bonus::TYPE_PERCENT,
            'prize' => 10
        ]);
        Bonus::create([
            'name' => 'Double Deposit Bonus',
            'slug' => 'double-deposit',
            'description' => 'Deposit up to €100 and get double credits!',
            'type' => Bonus::TYPE_MULTIPLIER,
            'prize' => 2
        ]);
        Bonus::create([
            'name' => 'Birthday Bonus',
            'slug' => 'birthday',
            'description' => 'Get an extra % on all your winnings. It\'s your birthday!',
            'type' => Bonus::TYPE_PERCENT,
            'prize' => 7
        ]);

    }
}
