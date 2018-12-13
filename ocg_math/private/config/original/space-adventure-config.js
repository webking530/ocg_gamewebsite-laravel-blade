// SPACE ADVENTURE, LUCKY CHRISTMAS, MR CHICKEN and RAMSES TREASURE configuration

// ORIGINAL
// const bonus3 = 0.5 * 5 + 0.35 * 50 + 0.15 * 100;
// const bonus4 = 0.5 * 10 + 0.35 * 100 + 0.15 * 200;
// const bonus5 = 0.5 * 50 + 0.35 * 200 + 0.15 * 500;

// MODIFIED
const bonus3 = 0.5 * 5 + 0.35 * 10 + 0.15 * 25;
const bonus4 = 0.5 * 10 + 0.35 * 25 + 0.15 * 50;
const bonus5 = 0.5 * 25 + 0.35 * 50 + 0.15 * 100;

module.exports = {
    name: 'SpaceAdventure',

    size: {
        reels: 5,
        rows: 3
    },

    // ORIGINAL
    // symbols: [
    //     {
    //         id: 1,
    //         occurrences: [1, 1, 1, 1, 1],
    //         paytable: [0, 0, 150, 250, 500]
    //     },
    //     {
    //         id: 2,
    //         occurrences: [2, 2, 2, 2, 2],
    //         paytable: [0, 0, 100, 150, 200]
    //     },
    //     {
    //         id: 3,
    //         occurrences: [3, 3, 3, 3, 3],
    //         paytable: [0, 0, 50, 100, 150]
    //     },
    //     {
    //         id: 4,
    //         occurrences: [4, 4, 4, 4, 4],
    //         paytable: [0, 10, 25, 50, 100]
    //     },
    //     {
    //         id: 5,
    //         occurrences: [4, 4, 4, 4, 4],
    //         paytable: [0, 10, 25, 50, 100]
    //     },
    //     {
    //         id: 6,
    //         occurrences: [6, 6, 6, 6, 6],
    //         paytable: [0, 5, 15, 25, 50]
    //     },
    //     {
    //         id: 7,
    //         occurrences: [7, 7, 7, 7, 7],
    //         paytable: [0, 2, 10, 20, 35]
    //     },
    //     {
    //         id: 8,
    //         occurrences: [8, 8, 8, 8, 8],
    //         paytable: [0, 1, 5, 10, 15]
    //     }
    // ],
    // bonusSymbol: {
    //     id: 9,
    //     occurrences: [2, 2, 2, 2, 2],
    //     paytable: [0, 0, bonus3, bonus4, bonus5]
    // },
    // wildSymbol: {
    //     id: 10,
    //     occurrences: [1, 1, 1, 1, 1]
    // },
    // freeSpinsSymbol: {
    //     id: 11,
    //     occurrences: [0, 0, 0, 0, 0],
    //     paytable: [0, 0, 0, 0, 0]
    // },

    // MODIFIED
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
            occurrences: [6, 5, 4, 4, 4],
            paytable: [0, 0, 25, 50, 100]
        },
        {
            id: 6,
            occurrences: [7, 6, 5, 5, 5],
            paytable: [0, 0, 15, 25, 50]
        },
        {
            id: 7,
            occurrences: [8, 7, 6, 6, 6],
            paytable: [0, 0, 10, 20, 35]
        },
        {
            id: 8,
            occurrences: [9, 8, 7, 7, 7],
            paytable: [0, 0, 5, 10, 15]
        }
    ],
    bonusSymbol: {
        id: 9,
        occurrences: [1, 1, 1, 1, 1],
        paytable: [0, 0, bonus3, bonus4, bonus5]
    },
    wildSymbol: {
        id: 10,
        occurrences: [1, 1, 0, 1, 1]
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