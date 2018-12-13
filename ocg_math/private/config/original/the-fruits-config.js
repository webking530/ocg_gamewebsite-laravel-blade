// THE FRUITS and ULTIMATE SOCCER configuration
module.exports = {
    name: 'TheFruits',

    size: {
        reels: 5,
        rows: 3
    },

    // ORIGINAL
    // symbols: [
    //     {
    //         id: 1,
    //         occurrences: [1, 1, 1, 1, 1],
    //         paytable: [0, 0, 100, 150, 200]
    //     },
    //     {
    //         id: 2,
    //         occurrences: [2, 2, 2, 2, 2],
    //         paytable: [0, 0, 50, 100, 150]
    //     },
    //     {
    //         id: 3,
    //         occurrences: [3, 3, 3, 3, 3],
    //         paytable: [0, 10, 25, 50, 100]
    //     },
    //     {
    //         id: 4,
    //         occurrences: [4, 4, 4, 4, 4],
    //         paytable: [0, 10, 25, 50, 100]
    //     },
    //     {
    //         id: 5,
    //         occurrences: [4, 4, 4, 4, 4],
    //         paytable: [0, 5, 15, 25, 50]
    //     },
    //     {
    //         id: 6,
    //         occurrences: [6, 6, 6, 6, 6],
    //         paytable: [0, 2, 10, 20, 35]
    //     },
    //     {
    //         id: 7,
    //         occurrences: [6, 6, 6, 6, 6],
    //         paytable: [0, 1, 5, 10, 15]
    //     },
    // ],
    // wildSymbol: {
    //     id: 8,
    //     occurrences: [1, 1, 1, 1, 1]
    // },
    // bonusSymbol: {
    //     id: 9,
    //     occurrences: [0, 0, 0, 0, 0],
    //     paytable: [0, 0, 0, 0, 0]
    // },
    // freeSpinsSymbol: {
    //     id: 10,
    //     occurrences: [0, 0, 0, 0, 0],
    //     paytable: [0, 0, 0, 0, 0]
    // },

    // MODIFIED
    symbols: [
        {
            id: 1,
            occurrences: [3, 2, 1, 1, 1],
            paytable: [0, 0, 100, 150, 200]
        },
        {
            id: 2,
            occurrences: [4, 3, 2, 2, 2],
            paytable: [0, 0, 50, 100, 150]
        },
        {
            id: 3,
            occurrences: [5, 4, 3, 3, 3],
            paytable: [0, 0, 25, 50, 100]
        },
        {
            id: 4,
            occurrences: [5, 4, 3, 3, 3],
            paytable: [0, 0, 25, 50, 100]
        },
        {
            id: 5,
            occurrences: [6, 5, 4, 4, 4],
            paytable: [0, 0, 15, 25, 50]
        },
        {
            id: 6,
            occurrences: [7, 6, 5, 5, 5],
            paytable: [0, 0, 10, 20, 35]
        },
        {
            id: 7,
            occurrences: [8, 7, 6, 6, 6],
            paytable: [0, 0, 5, 10, 15]
        }
    ],
    wildSymbol: {
        id: 8,
        occurrences: [1, 1, 0, 1, 1]
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