module.exports = {
    name: 'bonus-wheel-4',

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
            id: [1, 5],
            occurrences: [10],
            paytable: [5]
        },
        {
            id: [2, 10],
            occurrences: [5],
            paytable: [10]
        },
        {
            id: [3, 20],
            occurrences: [5],
            paytable: [20]
        },
        {
            id: [4, 0],
            occurrences: [5],
            paytable: [0]
        },

        {
            id: [5, 5],
            occurrences: [10],
            paytable: [5]
        },
        {
            id: [6, 10],
            occurrences: [7],
            paytable: [10]
        },
        {
            id: [7, 20],
            occurrences: [5],
            paytable: [20]
        },
        {
            id: [8, 40],
            occurrences: [3],
            paytable: [40]
        },
        {
            id: [9, 0],
            occurrences: [5],
            paytable: [0]
        },

        {
            id: [10, 10],
            occurrences: [6],
            paytable: [10]
        },
        {
            id: [11, 25],
            occurrences: [4],
            paytable: [25]
        },
        {
            id: [12, 50],
            occurrences: [3],
            paytable: [50]
        },
        {
            id: [13, 100],
            occurrences: [2],
            paytable: [100]
        },
        {
            id: [14, 0],
            occurrences: [5],
            paytable: [0]
        },

        {
            id: [15, 50],
            occurrences: [4],
            paytable: [50]
        },
        {
            id: [16, 100],
            occurrences: [3],
            paytable: [100]
        },
        {
            id: [17, 150],
            occurrences: [2],
            paytable: [150]
        },
        {
            id: [18, 200],
            occurrences: [1],
            paytable: [200]
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