// FOR GAMES WITH WILD AND BONUS FEATURES
const bonus3 = 0.5 * 5 + 0.35 * 10 + 0.15 * 25;
const bonus4 = 0.5 * 10 + 0.35 * 25 + 0.15 * 50;
const bonus5 = 0.5 * 25 + 0.35 * 50 + 0.15 * 100;

module.exports = {
    name: 'SpaceAdventure',

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
            paytable: [0, 0, 20, 50, 400]
        },
        {
            id: 4,
            occurrences: [7, 5, 3, 3, 3],
            paytable: [0, 0, 20, 50, 400]
        },
        {
            id: 5,
            occurrences: [8, 6, 4, 4, 4],
            paytable: [0, 0, 10, 30, 200]
        },
        {
            id: 6,
            occurrences: [8, 6, 4, 4, 4],
            paytable: [0, 0, 10, 30, 200]
        },
        {
            id: 7,
            occurrences: [9, 7, 5, 5, 5],
            paytable: [0, 0, 10, 20, 100]
        },
        {
            id: 8,
            occurrences: [9, 7, 5, 5, 5],
            paytable: [0, 0, 10, 20, 100]
        }
    ],
    wildSymbol: {
        id: 10,
        occurrences: [1, 1, 0, 1, 1]
    },
    bonusSymbol: {
        id: 9,
        occurrences: [5, 5, 5, 5, 5],
        paytable: [0, 0, bonus3, bonus4, bonus5]
    },
    freeSpinsSymbol: {
        id: 11,
        occurrences: [0, 0, 0, 0, 0],
        paytable: [0, 0, 0, 0, 0]
    },

    paylines: [
        [{ row: 1, reel: 0 }, { row: 1, reel: 1 }, { row: 1, reel: 2 }, { row: 1, reel: 3 }, { row: 1, reel: 4 }],
        [{ row: 0, reel: 0 }, { row: 0, reel: 1 }, { row: 0, reel: 2 }, { row: 0, reel: 3 }, { row: 0, reel: 4 }],
        [{ row: 2, reel: 0 }, { row: 2, reel: 1 }, { row: 2, reel: 2 }, { row: 2, reel: 3 }, { row: 2, reel: 4 }],
        [{ row: 0, reel: 0 }, { row: 1, reel: 1 }, { row: 2, reel: 2 }, { row: 1, reel: 3 }, { row: 0, reel: 4 }],
        [{ row: 2, reel: 0 }, { row: 1, reel: 1 }, { row: 0, reel: 2 }, { row: 1, reel: 3 }, { row: 2, reel: 4 }],
    ]
};