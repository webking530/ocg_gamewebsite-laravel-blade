const utils = require('./../utils');

module.exports = ({
    options,
    reels,
    lines = 20
}) => {
    let games = 1;
    for (const reel of options.reels) {
        games *= reel;
    }
    lines = Math.max(0, Math.min(options.paylines.length, lines));
    const paytable = utils.getPaytable(options.symbols);
    const results = {
        // TODO - Handle finding highest paid symbol if needed
        wins: new Array(paytable[1][options.size.reels - 1] * lines + 1).fill(0),
        total: {
            hitFrequency: 0,
            rtp: 0
        },
    };
    let hitFrequency = 0;
    let totalWin = 0;
    for (let i = 0; i < games; ++i) {
        const indice = [];
        let game = i;
        for (let j = 0; j < options.size.reels; ++j) {
            indice.push(game % options.reels[j]);
            game = Math.floor(game / options.reels[j]);
        }
        const combination = utils.getCombination(reels, options.size.rows, indice);
        let win = 0;
        for (let i = 0; i < lines; ++i) {
            win += utils.getPaylineWin(combination, paytable, options.paylines[i], options.wildSymbol.id, options.bonusSymbol.id, options.freeSpinsSymbol.id);
        }
        win += lines * utils.getBonusWin(combination, options.bonusSymbol.paytable, options.bonusSymbol.id);
        win += lines * utils.getFreeSpinsWin(combination, options.freeSpinsSymbol.paytable, options.freeSpinsSymbol.id);
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