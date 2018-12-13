module.exports = {
    port: 3000,
    games: {
        'wild': {
            config: require('./config/official/wild'),
            bonus3: undefined,
            bonus4: undefined,
            bonus5: undefined,
            freeSpins: undefined,
        },
        'wild-bonus': {
            config: require('./config/official/wild-bonus'),
            bonus3: require('./config/official/bonus-item-3'),
            bonus4: require('./config/official/bonus-item-4'),
            bonus5: require('./config/official/bonus-item-5'),
            freeSpins: undefined,
        },
        'wild-bonus-freeSpins': {
            config: require('./config/official/wild-bonus-freeSpins'),
            bonus3: require('./config/official/bonus-wheel-3'),
            bonus4: require('./config/official/bonus-wheel-4'),
            bonus5: require('./config/official/bonus-wheel-5'),
            freeSpins: require('./config/official/free-spins'),
        },
        'freeSpins': {
            config: require('./config/official/freeSpins'),
            bonus3: require('./config/official/bonus-wheel-3'),
            bonus4: require('./config/official/bonus-wheel-4'),
            bonus5: require('./config/official/bonus-wheel-5'),
            freeSpins: require('./config/official/free-spins'),
        }
    }
};