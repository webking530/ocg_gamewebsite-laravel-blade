module.exports = {
    name: 'BonusItem3',

    size: {
        reels: 1,
        rows: 1
    },

    symbols: [
        {
            id: [0, 5],
            occurrences: [50],
            paytable: [5]
        },
        {
            id: [1, 10],
            occurrences: [35],
            paytable: [10]
        },
        {
            id: [2, 25],
            occurrences: [15],
            paytable: [25]
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