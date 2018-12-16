module.exports = {
    port: 3000,
    games: {
        'TheFruits': {
        //     'slot-machine-the-fruits': {
            config: require('./config/TheFruits'),
            bonus3: undefined,
            bonus4: undefined,
            bonus5: undefined,
            freeSpins: undefined,
        },
        'SpaceAdventure': {
        //     'slot-machine-space-adventure': {
            config: require('./config/SpaceAdventure'),
            bonus3: require('./config/BonusItem3'),
            bonus4: require('./config/BonusItem4'),
            bonus5: require('./config/BonusItem5'),
            freeSpins: undefined,
        },
        'ArabianNights': {
        //     'slot-machine-arabian-nights': {
            config: require('./config/ArabianNights'),
            bonus3: require('./config/BonusWheel3'),
            bonus4: require('./config/BonusWheel4'),
            bonus5: require('./config/BonusWheel5'),
            freeSpins: require('./config/FreeSpins'),
        },
        'ArabianNightsFreeSpins': {
        //     'slot-machine-arabian-nights0free-spins': {
            config: require('./config/ArabianNightsFreeSpins'),
            bonus3: require('./config/BonusWheel3'),
            bonus4: require('./config/BonusWheel4'),
            bonus5: require('./config/BonusWheel5'),
            freeSpins: require('./config/FreeSpins'),
        }
    }
};