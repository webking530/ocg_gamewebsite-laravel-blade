// ARABIAN NIGHTS configuration

// ORIGINAL
// const bonus3 =
//     10 * 6 / 93 +
//     30 * 6 / 93 +
//     60 * 6 / 93 +
//     90 * 5 / 93 +
//     0 * 6 / 93 +
//     20 * 5 / 93 +
//     60 * 4 / 93 +
//     120 * 3 / 93 +
//     200 * 1 / 93 +
//     0 * 5 / 93 +
//     40 * 5 / 93 +
//     30 * 6 / 93 +
//     20 * 7 / 93 +
//     10 * 5 / 93 +
//     0 * 4 / 93 +
//     80 * 4 / 93 +
//     60 * 5 / 93 +
//     40 * 5 / 93 +
//     1000 * 1 / 93 +
//     0 * 4 / 93;
// const bonus4 = bonus3;
// const bonus5 = bonus3;

// const freeSpins3 = 4 * 0.5;
// const freeSpins4 = 6 * 0.5;
// const freeSpins5 = 8 * 0.5;

// MODIFIED
const bonus3 =
    1 * 0.10 +
    2 * 0.10 +
    5 * 0.05 +
    10 * 0.05 +
    0 * 0.05 +
    2 * 0.10 +
    5 * 0.07 +
    10 * 0.05 +
    20 * 0.03 +
    0 * 0.05 +
    5 * 0.06 +
    10 * 0.04 +
    20 * 0.03 +
    50 * 0.02 +
    0 * 0.05 +
    25 * 0.04 +
    50 * 0.03 +
    75 * 0.02 +
    100 * 0.01 +
    0 * 0.05;
const bonus4 =
    1 * 0.10 +
    5 * 0.10 +
    10 * 0.05 +
    20 * 0.05 +
    0 * 0.05 +
    5 * 0.10 +
    10 * 0.07 +
    20 * 0.05 +
    40 * 0.03 +
    0 * 0.05 +
    10 * 0.06 +
    25 * 0.04 +
    50 * 0.03 +
    100 * 0.02 +
    0 * 0.05 +
    50 * 0.04 +
    100 * 0.03 +
    150 * 0.02 +
    200 * 0.01 +
    0 * 0.05;
const bonus5 =
    1 * 0.10 +
    10 * 0.10 +
    20 * 0.05 +
    40 * 0.05 +
    0 * 0.05 +
    10 * 0.10 +
    20 * 0.07 +
    25 * 0.05 +
    50 * 0.03 +
    0 * 0.05 +
    25 * 0.06 +
    50 * 0.04 +
    100 * 0.03 +
    200 * 0.02 +
    0 * 0.05 +
    100 * 0.04 +
    200 * 0.03 +
    250 * 0.02 +
    500 * 0.01 +
    0 * 0.05;

const freeSpins3 = 4 * 0.6;
const freeSpins4 = 6 * 0.6;
const freeSpins5 = 8 * 0.6;

module.exports = {
    name: 'ArabianNights',

    size: {
        reels: 5,
        rows: 3
    },

    // ORIGINAL
    // symbols: [
    //     {
    //         id: 1,
    //         occurrences: [1, 1, 1, 1, 1],
    //         paytable: [0, 0, 90, 150, 200]
    //     },
    //     {
    //         id: 2,
    //         occurrences: [2, 2, 2, 2, 2],
    //         paytable: [0, 0, 80, 110, 160]
    //     },
    //     {
    //         id: 3,
    //         occurrences: [3, 3, 3, 3, 3],
    //         paytable: [0, 0, 70, 100, 150]
    //     },
    //     {
    //         id: 4,
    //         occurrences: [4, 4, 4, 4, 4],
    //         paytable: [0, 0, 50, 80, 110]
    //     },
    //     {
    //         id: 5,
    //         occurrences: [5, 5, 5, 5, 5],
    //         paytable: [0, 0, 40, 60, 80]
    //     },
    //     {
    //         id: 6,
    //         occurrences: [6, 6, 6, 6, 6],
    //         paytable: [0, 0, 30, 50, 70]
    //     },
    //     {
    //         id: 7,
    //         occurrences: [7, 7, 7, 7, 7],
    //         paytable: [0, 0, 20, 30, 50]
    //     }
    // ],
    // wildSymbol: {
    //     id: 8,
    //     occurrences: [1, 1, 1, 1, 1]
    // },
    // bonusSymbol: {
    //     id: 9,
    //     occurrences: [2, 2, 2, 2, 2],
    //     paytable: [0, 0, bonus3, bonus4, bonus5]
    // },
    // freeSpinsSymbol: {
    //     id: 10,
    //     occurrences: [2, 2, 2, 2, 2],
    //     paytable: [0, 0, freeSpins3, freeSpins4, freeSpins5]
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
        occurrences: [1, 1, 0, 1, 1]
    },
    bonusSymbol: {
        id: 9,
        occurrences: [1, 1, 1, 1, 1],
        paytable: [0, 0, bonus3, bonus4, bonus5]
    },
    freeSpinsSymbol: {
        id: 10,
        occurrences: [1, 1, 1, 1, 1],
        paytable: [0, 0, freeSpins3, freeSpins4, freeSpins5]
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