module.exports = {
    name: 'FreeSpins',

    size: {
        reels: 5,
        rows: 1
    },

    symbols: [
        {
            id: [0],
            occurrences: [1, 0, 0, 0, 0],
            paytable: [0, 0, 0, 0, 0]
        },
        {
            id: [0],
            occurrences: [0, 1, 0, 0, 0],
            paytable: [0, 0, 0, 0, 0]
        },
        {
            id: [4],
            occurrences: [0, 0, 1, 0, 0],
            paytable: [0, 0, 0, 0, 0]
        },
        {
            id: [6],
            occurrences: [0, 0, 0, 1, 0],
            paytable: [0, 0, 0, 0, 0]
        },
        {
            id: [8],
            occurrences: [0, 0, 0, 0, 1],
            paytable: [0, 0, 0, 0, 0]
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
    }
};