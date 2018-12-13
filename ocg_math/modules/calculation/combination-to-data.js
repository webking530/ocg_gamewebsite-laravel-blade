const utils = require('../utils');

module.exports = ({
    config,
    reels,
    bonus,
    freeSpins,
    lines = 20
}) => {
    lines = Math.max(0, Math.min(config.paylines.length, lines));
    const paytable = utils.getPaytable(config.symbols);
    const data = {
        combination: [],
        wins: [],
        win: 0,
        bonus: false,
        numItemInBonus: 0,
        bonusData: {},
        freeSpins: false,
        freeSpinsData: {}
    };
    for (let i = 0; i < config.size.rows; ++i) {
        data.combination.push([]);
    }
    let combination = utils.getRandomCombination(reels, config.size.rows);
    for (let i = 0; i < config.size.reels; ++i) {
        for (let j = 0; j < config.size.rows; ++j) {
            data.combination[j].push(combination[i][j]);
        }
    }
    for (let i = 0; i < lines; ++i) {
        const winLine = utils.getCombinationPaylineWin(combination, paytable, config.paylines[i], config.wildSymbol.id, config.bonusSymbol.id, config.freeSpinsSymbol.id);
        if (winLine) {
            data.wins.push({ ...winLine, line: i + 1 });
            data.win += winLine.amount;
        }
    }
    const bonusWin = utils.getCombinationBonusWin(combination, bonus, config.bonusSymbol.id);
    if (bonusWin.bonus) {
        data.wins.push(bonusWin.winLine);
    }
    data.bonus = bonusWin.bonus;
    data.numItemInBonus = bonusWin.numItemInBonus;
    data.bonusData = bonusWin.data;
    const freeSpinsWin = utils.getCombinationFreeSpinsWin(combination, freeSpins, config.freeSpinsSymbol.id);
    if (freeSpinsWin.freeSpins) {
        data.wins.push(freeSpinsWin.winLine);
    }
    data.freeSpins = freeSpinsWin.freeSpins;
    data.freeSpinsData = freeSpinsWin.data;
    return data
};