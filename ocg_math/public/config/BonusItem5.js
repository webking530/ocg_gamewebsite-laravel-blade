module.exports = {
    name: 'BonusItem5',

    size: {
        reels: 1,
        rows: 1
    },

    symbols: [
        {
            id: [0, 25],
            occurrences: [50],
            paytable: [25]
        },
        {
            id: [1, 50],
            occurrences: [35],
            paytable: [50]
        },
        {
            id: [2, 100],
            occurrences: [15],
            paytable: [100]
        }
    ],
    wildSymbol: {
        id: 1,
        occurrences: [0, 0, 0, 0, 0]
    },
    bonusSymbol: {
        id: 2,
        occurrences: [0, 0, 0, 0, 0],
        paytable: [0, 0, 0, 0, 0]
    },
    freeSpinsSymbol: {
        id: 3,
        occurrences: [0, 0, 0, 0, 0],
        paytable: [0, 0, 0, 0, 0]
    },

    paylines: [
        [{ row: 0, reel: 0 }]
    ]
};