module.exports = {
    port: 3000,
    games: {
        // Games with wild
        'TheFruits': {
            config: require('./config/TheFruits'),
            bonus3: undefined,
            bonus4: undefined,
            bonus5: undefined,
            freeSpins: undefined,
        },
        'TheFruitsDemo': {
            config: require('./config/TheFruitsDemo'),
            bonus3: undefined,
            bonus4: undefined,
            bonus5: undefined,
            freeSpins: undefined,
        },
        'TheFruitsLose': {
            config: require('./config/TheFruitsLose'),
            bonus3: undefined,
            bonus4: undefined,
            bonus5: undefined,
            freeSpins: undefined,
        },
        // Games with wild and bonus
        'SpaceAdventure': {
            config: require('./config/SpaceAdventure'),
            bonus3: require('./config/BonusItem3'),
            bonus4: require('./config/BonusItem4'),
            bonus5: require('./config/BonusItem5'),
            freeSpins: undefined,
        },
        'SpaceAdventureDemo': {
            config: require('./config/SpaceAdventureDemo'),
            bonus3: require('./config/BonusItem3'),
            bonus4: require('./config/BonusItem4'),
            bonus5: require('./config/BonusItem5'),
            freeSpins: undefined,
        },
        'SpaceAdventureLose': {
            config: require('./config/SpaceAdventureLose'),
            bonus3: require('./config/BonusItem3'),
            bonus4: require('./config/BonusItem4'),
            bonus5: require('./config/BonusItem5'),
            freeSpins: undefined,
        },
        // Games with wild, bonus and free spins
        'ArabianNights': {
            config: require('./config/ArabianNights'),
            bonus3: require('./config/BonusWheel3'),
            bonus4: require('./config/BonusWheel4'),
            bonus5: require('./config/BonusWheel5'),
            freeSpins: require('./config/FreeSpins'),
        },
        'ArabianNightsDemo': {
            config: require('./config/ArabianNightsDemo'),
            bonus3: require('./config/BonusWheel3'),
            bonus4: require('./config/BonusWheel4'),
            bonus5: require('./config/BonusWheel5'),
            freeSpins: require('./config/FreeSpins'),
        },
        'ArabianNightsFreeSpins': {
            config: require('./config/ArabianNightsFreeSpins'),
            bonus3: require('./config/BonusWheel3'),
            bonus4: require('./config/BonusWheel4'),
            bonus5: require('./config/BonusWheel5'),
            freeSpins: require('./config/FreeSpins'),
        },
        'ArabianNightsLose': {
            config: require('./config/ArabianNightsLose'),
            bonus3: require('./config/BonusWheel3'),
            bonus4: require('./config/BonusWheel4'),
            bonus5: require('./config/BonusWheel5'),
            freeSpins: require('./config/FreeSpins'),
        },
        // Games for test
        'Dummy': {
            config: require('./config/Dummy'),
            bonus3: undefined,
            bonus4: undefined,
            bonus5: undefined,
            freeSpins: undefined,
        }
    }
};