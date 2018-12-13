const utils = require('./../utils');

module.exports = ({
    config,
    reels,
    games = 1000000,
    lines = 20
}) => {
    lines = Math.max(0, Math.min(config.paylines.length, lines));
    const paytable = utils.getPaytable(config.symbols);
    const results = {
        // TODO - Handle finding highest paid symbol if needed
        wins: new Array(paytable[1][config.size.reels - 1] * lines + 1).fill(0),
        total: {
            hitFrequency: 0,
            rtp: 0
        },
    };
    let hitFrequency = 0;
    let totalWin = 0;
    for (let i = 0; i < games; ++i) {
        const combination = utils.getRandomCombination(reels, config.size.rows);
        let win = 0;
        for (let i = 0; i < lines; ++i) {
            win += utils.getPaylineWin(combination, paytable, config.paylines[i], config.wildSymbol.id, config.bonusSymbol.id, config.freeSpinsSymbol.id);
        }
        win += lines * utils.getBonusWin(combination, config.bonusSymbol.paytable, config.bonusSymbol.id);
        win += lines * utils.getFreeSpinsWin(combination, config.freeSpinsSymbol.paytable, config.freeSpinsSymbol.id);
        ++results.wins[Math.floor(win / lines)];
        if (win > 0) {
            ++hitFrequency;
            totalWin += win;
        }
    }
    results.wins = results.wins.map((wins, index) => ({ games: wins, winCoefficient: `${index}-${index + 1}` })).filter(wins => wins.games > 0);
    results.total.hitFrequency = hitFrequency / games;
    results.total.rtp = totalWin / (games * lines);
    return results;
};