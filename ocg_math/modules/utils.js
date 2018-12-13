module.exports = {
    // SIMULATION & CALCULATION
    // Gets each symbol paytable as a property inside an object
    getPaytable: (symbols) => {
        const paytable = {};
        for (const symbol of symbols) {
            paytable[symbol.id] = symbol.paytable;
        }
        return paytable;
    },
    // Gets random combination from given reels and number of reels
    getRandomCombination: (reels, numberOfSymbols) => {
        const combination = [];
        for (const reel of reels) {
            const symbols = [];
            let index = Math.floor(Math.random() * reel.length);
            while (symbols.length < numberOfSymbols) {
                symbols.push(reel[index]);
                index = (index + 1) % reel.length;
            }
            combination.push(symbols);
        }
        return combination;
    },
    // Gets wanted combination from given reels and number of reels
    getCombination: (reels, numberOfSymbols, indice) => {
        const combination = [];
        for (let i = 0; i < reels.length; ++i) {
            const reel = reels[i];
            const symbols = [];
            let index = indice[i] % reel.length;
            while (symbols.length < numberOfSymbols) {
                symbols.push(reel[index]);
                index = (index + 1) % reel.length;
            }
            combination.push(symbols);
        }
        return combination;
    },

    // SIMULATION
    // Gets win for given combination and payline based on paytable
    getPaylineWin: (combination, paytable, payline, wildSymbol, bonusSymbol, freeSpinsSymbol) => {
        // Find first symbol that is not wild on payline
        let index = 0;
        let symbol = combination[payline[index].reel][payline[index].row];
        while (symbol === wildSymbol && index < combination.length - 1) {
            ++index;
            symbol = combination[payline[index].reel][payline[index].row];
        }
        // If all are wilds return highest pay in higest payline
        if (index === combination.length - 1 && symbol === wildSymbol) {
            // TODO - Handle finding highest paid symbol if needed
            return paytable[1][combination.length - 1];
        }
        // If first not wild symbol is bonus or free spins symbol there is no win
        if (symbol === bonusSymbol || symbol === freeSpinsSymbol) {
            return 0;
        }
        // Count number of same (or wild) symbols on payline starting from the left side
        const paysymbols = [wildSymbol, symbol];
        let count = index + 1;
        for (let i = index + 1; i < combination.length; ++i) {
            if (paysymbols.includes(combination[payline[i].reel][payline[i].row])) {
                ++count;
            } else {
                break;
            }
        }
        return paytable[symbol][count - 1];
    },
    // Gets win for given combination bonus based on paytable
    getBonusWin: (combination, paytable, bonusSymbol) => {
        let count = 0;
        for (const reel of combination) {
            for (const symbol of reel) {
                if (symbol === bonusSymbol) {
                    ++count;
                }
            }
        }
        return count ? paytable[count - 1] : 0;
    },
    // Gets win for given combination free spins based on paytable
    getFreeSpinsWin: (combination, paytable, freeSpinsSymbol) => {
        let count = 0;
        for (const reel of combination) {
            for (const symbol of reel) {
                if (symbol === freeSpinsSymbol) {
                    ++count;
                }
            }
        }
        return count ? paytable[count - 1] : 0;
    },

    // CALCULATION
    // Gets win for given combination and payline based on paytable
    // It is structured in game readable format
    getCombinationPaylineWin: (combination, paytable, payline, wildSymbol, bonusSymbol, freeSpinsSymbol) => {
        const symbols = [];
        // Find first symbol that is not wild on payline
        let index = 0;
        let symbol = combination[payline[index].reel][payline[index].row];
        symbols.push({
            row: payline[index].row,
            col: payline[index].reel,
            value: symbol
        });
        while (symbol === wildSymbol && index < combination.length - 1) {
            ++index;
            symbol = combination[payline[index].reel][payline[index].row];
            symbols.push({
                row: payline[index].row,
                col: payline[index].reel,
                value: symbol
            });
        }
        // If all are wilds return highest pay in higest payline
        if (index === combination.length - 1 && symbol === wildSymbol) {
            // TODO - Handle finding highest paid symbol if needed
            return paytable[1][combination.length - 1];
        }
        // If first not wild symbol is bonus or free spins symbol there is no win
        if (symbol === bonusSymbol || symbol === freeSpinsSymbol) {
            return 0;
        }
        // Count number of same (or wild) symbols on payline starting from the left side
        const paysymbols = [wildSymbol, symbol];
        let count = index + 1;
        for (let i = index + 1; i < combination.length; ++i) {
            if (paysymbols.includes(combination[payline[i].reel][payline[i].row])) {
                ++count;
                symbols.push({
                    row: payline[i].row,
                    col: payline[i].reel,
                    value: combination[payline[i].reel][payline[i].row]
                });
            } else {
                break;
            }
        }
        if (paytable[symbol][count - 1]) {
            return {
                amount: paytable[symbol][count - 1],
                list: symbols,
                num_win: count,
                value: symbol
            };
        }
    },
    // Gets win for given combination bonus based on paytable
    // It is structured in game readable format
    getCombinationBonusWin: (combination, paytable, bonusSymbol) => {
        const symbols = [];
        let count = 0;
        for (let i = 0; i < combination.length; ++i) {
            for (let j = 0; j < combination[i].length; ++j) {
                if (combination[i][j] === bonusSymbol) {
                    ++count;
                    symbols.push({
                        row: j,
                        col: i,
                        value: bonusSymbol
                    });
                }
            }
        }
        const isBonus = count > 0 && paytable[count - 1].length > 0;
        let bonusWin = [-1, -1];
        if (isBonus) {
            bonusWin = paytable[count - 1][Math.floor(Math.random() * paytable[count - 1].length)];
        }
        return {
            bonus: isBonus,
            numItemInBonus: count,
            winLine: isBonus
                ? {
                    amount: 0,
                    line: 0,
                    list: symbols,
                    num_win: count,
                    value: bonusSymbol
                } : undefined,
            data: {
                id: bonusWin[0],
                amount: bonusWin[1]
            }
        };
    },
    // Gets win for given combination free spins based on paytable
    // It is structured in game readable format
    getCombinationFreeSpinsWin: (combination, paytable, freeSpinsSymbol) => {
        const symbols = [];
        let count = 0;
        for (let i = 0; i < combination.length; ++i) {
            for (let j = 0; j < combination[i].length; ++j) {
                if (combination[i][j] === freeSpinsSymbol) {
                    ++count;
                    symbols.push({
                        row: j,
                        col: i,
                        value: freeSpinsSymbol
                    });
                }
            }
        }
        const isFreeSpins = count > 0 && paytable[count - 1] > 0;
        let freeSpinsWin = -1;
        if (isFreeSpins) {
            console.log(paytable[count - 1]);
            freeSpinsWin = paytable[count - 1];
        }
        return {
            freeSpins: isFreeSpins,
            winLine: isFreeSpins
                ? {
                    amount: 0,
                    line: 0,
                    list: symbols,
                    num_win: count,
                    value: freeSpinsSymbol
                } : undefined,
            data: freeSpinsWin
        };
    }
};