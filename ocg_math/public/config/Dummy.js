// FOR GAMES WITH WILD FEATURE
module.exports = {
    name: 'Dummy',

    size: {
        reels: 5,
        rows: 3
    },

    symbols: [
        {
            id: 1,
            occurrences: [5, 3, 1, 1, 1],
            paytable: [0, 0, 40, 400, 1000]
        },
        {
            id: 2,
            occurrences: [6, 4, 2, 2, 2],
            paytable: [0, 0, 20, 100, 500]
        },
        {
            id: 3,
            occurrences: [7, 5, 3, 3, 3],
            paytable: [0, 0, 20, 80, 400]
        },
        {
            id: 4,
            occurrences: [8, 6, 4, 4, 4],
            paytable: [0, 0, 20, 40, 200]
        },
        {
            id: 5,
            occurrences: [9, 7, 5, 5, 5],
            paytable: [0, 0, 10, 20, 100]
        },
        {
            id: 6,
            occurrences: [10, 8, 6, 6, 6],
            paytable: [0, 0, 5, 20, 50]
        },
        {
            id: 7,
            occurrences: [11, 9, 7, 7, 7],
            paytable: [0, 0, 5, 10, 25]
        }
    ],
    wildSymbol: {
        id: 8,
        occurrences: [10, 10, 10, 10, 10]
    },
    bonusSymbol: {
        id: 9,
        occurrences: [0, 0, 0, 0, 0],
        paytable: [0, 0, 0, 0, 0]
    },
    freeSpinsSymbol: {
        id: 10,
        occurrences: [0, 0, 0, 0, 0],
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