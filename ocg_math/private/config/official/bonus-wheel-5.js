module.exports = {
    name: 'bonus-wheel-5',

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
            id: [1, 10],
            occurrences: [10],
            paytable: [10]
        },
        {
            id: [2, 20],
            occurrences: [5],
            paytable: [20]
        },
        {
            id: [3, 40],
            occurrences: [5],
            paytable: [40]
        },
        {
            id: [4, 0],
            occurrences: [5],
            paytable: [0]
        },

        {
            id: [5, 10],
            occurrences: [10],
            paytable: [10]
        },
        {
            id: [6, 20],
            occurrences: [7],
            paytable: [20]
        },
        {
            id: [7, 25],
            occurrences: [5],
            paytable: [25]
        },
        {
            id: [8, 50],
            occurrences: [3],
            paytable: [50]
        },
        {
            id: [9, 0],
            occurrences: [5],
            paytable: [0]
        },

        {
            id: [10, 25],
            occurrences: [6],
            paytable: [25]
        },
        {
            id: [11, 50],
            occurrences: [4],
            paytable: [50]
        },
        {
            id: [12, 100],
            occurrences: [3],
            paytable: [100]
        },
        {
            id: [13, 200],
            occurrences: [2],
            paytable: [200]
        },
        {
            id: [14, 0],
            occurrences: [5],
            paytable: [0]
        },

        {
            id: [15, 100],
            occurrences: [4],
            paytable: [100]
        },
        {
            id: [16, 200],
            occurrences: [3],
            paytable: [200]
        },
        {
            id: [17, 250],
            occurrences: [2],
            paytable: [250]
        },
        {
            id: [18, 500],
            occurrences: [1],
            paytable: [500]
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