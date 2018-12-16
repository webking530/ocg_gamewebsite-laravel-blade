<?php
return [
    'name' => [
        null,
        'Slot Machine - The Fruits',
        '3D Blackjack',
        'Slot Machine - Ultimate Soccer',
        '3D Roulette',
        'Slot Machine - Mr. Chicken',
        'Jacks or Better',
        'Slot Machine - Space Adventure',
        'Scratch Fruit',
        '3 Cards Monte',
        'High or Low',
        'Wheel of Fortune',
        'Keno',
        'Slot Machine - Ramses Treasure',
        'Slot Machine - Lucky Christmas',
        'Slot Machine - Arabian Nights',
        'Bingo',
        'Baccarat',
        'Craps',
        'Caribbean Stud',
        'Pai Gow Poker',
        'Joker Poker',
        'Three Card Poker',
        'Spin and Win',
        'Plinko',
        'Roulette Royale',
        'American Roulette Royale',
    ],
    'type' => [
        'Regular Game',
        'Instant Win'
    ],
    'group' => [
        'Slot',
        'Roulette',
        'Card',
        'Bingo',
        'Other'
    ],
    'setting_changed' => 'Game Settings Successfully Updated',
    'errors' => [
        \Models\Gaming\GameService::ERROR_CODE_CUSTOM => 'Custom error code (internal use)',
        \Models\Gaming\GameService::ERROR_CODE_INVALID_BET => 'The bet you have placed is invalid',
        \Models\Gaming\GameService::ERROR_CODE_INVALID_LINES => 'The amount of lines you have selected is invalid',
        \Models\Gaming\GameService::ERROR_CODE_INVALID_TOKEN => 'This game session is no longer valid',
        \Models\Gaming\GameService::ERROR_CODE_USER_NO_CREDITS => 'You do not have enough credits to play',
        \Models\Gaming\GameService::ERROR_CODE_GAME_NO_CREDITS => 'Game has no money (internal use)',
    ]
   ];