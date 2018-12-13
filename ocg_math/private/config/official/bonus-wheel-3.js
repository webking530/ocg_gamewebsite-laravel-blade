module.exports = {
    name: 'bonus-wheel-3',

    size: {
        reels: 1,
        rows: 1
    },

    symbols: [
        {
            id: [0, 1],
            occurrences: [10],
            paytable: [1]
        },
        {
            id: [1, 2],
            occurrences: [10],
            paytable: [2]
        },
        {
            id: [2, 5],
            occurrences: [5],
            paytable: [5]
        },
        {
            id: [3, 10],
            occurrences: [5],
            paytable: [10]
        },
        {
            id: [4, 0],
            occurrences: [5],
            paytable: [0]
        },

        {
            id: [5, 2],
            occurrences: [10],
            paytable: [2]
        },
        {
            id: [6, 5],
            occurrences: [7],
            paytable: [5]
        },
        {
            id: [7, 10],
            occurrences: [5],
            paytable: [10]
        },
        {
            id: [8, 20],
            occurrences: [3],
            paytable: [20]
        },
        {
            id: [9, 0],
            occurrences: [5],
            paytable: [0]
        },

        {
            id: [10, 5],
            occurrences: [6],
            paytable: [5]
        },
        {
            id: [11, 10],
            occurrences: [4],
            paytable: [10]
        },
        {
            id: [12, 20],
            occurrences: [3],
            paytable: [20]
        },
        {
            id: [13, 50],
            occurrences: [2],
            paytable: [50]
        },
        {
            id: [14, 0],
            occurrences: [5],
            paytable: [0]
        },

        {
            id: [15, 25],
            occurrences: [4],
            paytable: [25]
        },
        {
            id: [16, 50],
            occurrences: [3],
            paytable: [50]
        },
        {
            id: [17, 75],
            occurrences: [2],
            paytable: [75]
        },
        {
            id: [18, 100],
            occurrences: [1],
            paytable: [100]
        },
        {
            id: [19, 0],
            occurrences: [5],
            paytable: [0]
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