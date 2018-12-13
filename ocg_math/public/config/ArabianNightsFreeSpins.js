// ARABIAN NIGHTS FREE SPINS configuration

module.exports = {
    name: 'ArabianNightsFreeSpins',

    size: {
        reels: 5,
        rows: 3
    },

    symbols: [
        {
            id: 1,
            occurrences: [3, 2, 1, 1, 1],
            paytable: [0, 0, 150, 250, 500]
        },
        {
            id: 2,
            occurrences: [4, 3, 2, 2, 2],
            paytable: [0, 0, 100, 150, 200]
        },
        {
            id: 3,
            occurrences: [5, 4, 3, 3, 3],
            paytable: [0, 0, 50, 100, 150]
        },
        {
            id: 4,
            occurrences: [6, 5, 4, 4, 4],
            paytable: [0, 0, 25, 50, 100]
        },
        {
            id: 5,
            occurrences: [7, 6, 5, 5, 5],
            paytable: [0, 0, 15, 25, 50]
        },
        {
            id: 6,
            occurrences: [8, 7, 6, 6, 6],
            paytable: [0, 0, 10, 20, 35]
        },
        {
            id: 7,
            occurrences: [9, 8, 7, 7, 7],
            paytable: [0, 0, 5, 10, 15]
        }
    ],
    wildSymbol: {
        id: 8,
        occurrences: [0, 1, 0, 1, 1]
    },
    bonusSymbol: {
        id: 9,
        occurrences: [1, 0, 1, 0, 0],
        paytable: [0, 0, 0, 0, 0]
    },
    freeSpinsSymbol: {
        id: 10,
        occurrences: [1, 0, 1, 0, 0],
        paytable: [0, 0, 0, 0, 0]
    },

    paylines: [
        [{ row: 1, reel: 0 }, { row: 1, reel: 1 }, { row: 1, reel: 2 }, { row: 1, reel: 3 }, { row: 1, reel: 4 }],
        [{ row: 0, reel: 0 }, { row: 0, reel: 1 }, { row: 0, reel: 2 }, { row: 0, reel: 3 }, { row: 0, reel: 4 }],
        [{ row: 2, reel: 0 }, { row: 2, reel: 1 }, { row: 2, reel: 2 }, { row: 2, reel: 3 }, { row: 2, reel: 4 }],
        [{ row: 0, reel: 0 }, { row: 1, reel: 1 }, { row: 2, reel: 2 }, { row: 1, reel: 3 }, { row: 0, reel: 4 }],
        [{ row: 2, reel: 0 }, { row: 1, reel: 1 }, { row: 0, reel: 2 }, { row: 1, reel: 3 }, { row: 2, reel: 4 }],
        [{ row: 1, reel: 0 }, { row: 0, reel: 1 }, { row: 0, reel: 2 }, { row: 0, reel: 3 }, { row: 1, reel: 4 }],
        [{ row: 1, reel: 0 }, { row: 2, reel: 1 }, { row: 2, reel: 2 }, { row: 2, reel: 3 }, { row: 1, reel: 4 }],
        [{ row: 0, reel: 0 }, { row: 0, reel: 1 }, { row: 1, reel: 2 }, { row: 2, reel: 3 }, { row: 2, reel: 4 }],
        [{ row: 2, reel: 0 }, { row: 2, reel: 1 }, { row: 1, reel: 2 }, { row: 0, reel: 3 }, { row: 0, reel: 4 }],
        [{ row: 1, reel: 0 }, { row: 2, reel: 1 }, { row: 1, reel: 2 }, { row: 0, reel: 3 }, { row: 1, reel: 4 }],
        [{ row: 2, reel: 0 }, { row: 0, reel: 1 }, { row: 1, reel: 2 }, { row: 2, reel: 3 }, { row: 1, reel: 4 }],
        [{ row: 0, reel: 0 }, { row: 1, reel: 1 }, { row: 1, reel: 2 }, { row: 1, reel: 3 }, { row: 0, reel: 4 }],
        [{ row: 2, reel: 0 }, { row: 1, reel: 1 }, { row: 1, reel: 2 }, { row: 1, reel: 3 }, { row: 2, reel: 4 }],
        [{ row: 0, reel: 0 }, { row: 1, reel: 1 }, { row: 0, reel: 2 }, { row: 1, reel: 3 }, { row: 0, reel: 4 }],
        [{ row: 2, reel: 0 }, { row: 1, reel: 1 }, { row: 2, reel: 2 }, { row: 1, reel: 3 }, { row: 2, reel: 4 }],
        [{ row: 1, reel: 0 }, { row: 1, reel: 1 }, { row: 0, reel: 2 }, { row: 1, reel: 3 }, { row: 1, reel: 4 }],
        [{ row: 1, reel: 0 }, { row: 1, reel: 1 }, { row: 2, reel: 2 }, { row: 1, reel: 3 }, { row: 1, reel: 4 }],
        [{ row: 0, reel: 0 }, { row: 0, reel: 1 }, { row: 2, reel: 2 }, { row: 0, reel: 3 }, { row: 0, reel: 4 }],
        [{ row: 2, reel: 0 }, { row: 2, reel: 1 }, { row: 0, reel: 2 }, { row: 2, reel: 3 }, { row: 2, reel: 4 }],
        [{ row: 0, reel: 0 }, { row: 2, reel: 1 }, { row: 2, reel: 2 }, { row: 2, reel: 3 }, { row: 0, reel: 4 }]
    ]
};