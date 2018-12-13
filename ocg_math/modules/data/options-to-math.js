const utils = require('./../utils');

module.exports = options => {
    const math = {
        symbols: [],
        bonus: [],
        freeSpins: [],
        total: {
            hitFrequency: 0,
            rtp: 0
        },
    };
    for (const symbol of options.symbols) {
        // Set calculation variables
        const symbolMath = [];
        let occurrenceChance = 1;
        for (let i = 0; i < options.size.reels; ++i) {
            symbolMath.push({
                hitFrequency: 0,
                rtp: 0
            });
            occurrenceChance *= (symbol.occurrenceChances[i] + options.wildSymbol.occurrenceChances[i]);
        }
        let previousHitFrequencies = 0;
        // Calculate math from biggest to smallest win
        for (let i = options.size.reels - 1; i >= 0; --i) {
            if (!symbol.paytable[i]) {
                break;
            }
            const hitFrequency = occurrenceChance - previousHitFrequencies;
            previousHitFrequencies += hitFrequency;
            const rtp = hitFrequency * symbol.paytable[i];
            symbolMath[i].hitFrequency = hitFrequency;
            symbolMath[i].rtp = rtp;
            math.total.hitFrequency += hitFrequency;
            math.total.rtp += rtp;
            occurrenceChance /= (symbol.occurrenceChances[i] + options.wildSymbol.occurrenceChances[i]);
        }
        math.symbols.push({ id: symbol.id, ...symbolMath });
    }
    // Calculate bonus and free spins math from biggest to smallest win
    math.bonus = getScatterMath(options.bonusSymbol.occurrenceChances, options.bonusSymbol.paytable);
    math.freeSpins = getScatterMath(options.freeSpinsSymbol.occurrenceChances, options.freeSpinsSymbol.paytable);
    for (let i = 0; i < options.size.reels; ++i) {
        math.total.hitFrequency += math.bonus[i].hitFrequency;
        math.total.rtp += math.bonus[i].rtp;
        math.total.hitFrequency += math.freeSpins[i].hitFrequency;
        math.total.rtp += math.freeSpins[i].rtp;
    }
    return math;
};

const getScatterMath = (occurrenceChances, paytable) => {
    let combinations = Math.pow(2, occurrenceChances.length);
    occurrenceChances = occurrenceChances.map(occurrenceChance => [occurrenceChance, 1 - occurrenceChance]);
    const data = [];
    for (let i = 0; i < paytable.length; ++i) {
        data.push({
            hitFrequency: 0,
            rtp: 0
        });
    }
    for (let i = 0; i < combinations; ++i) {
        const indice = [];
        let combinationIndex = i;
        let hits = 0;
        for (let j = 0; j < paytable.length; ++j) {
            if (combinationIndex % 2 === 0) {
                ++hits;
            }
            indice.push(combinationIndex % 2);
            combinationIndex = Math.floor(combinationIndex / 2);
        }
        if (!hits || !paytable[hits - 1]) {
            continue;
        }
        const combination = utils.getCombination(occurrenceChances, 1, indice);
        const hitFrequency = combination.reduce((a, b) => a * b);
        data[hits - 1].hitFrequency += hitFrequency;
        data[hits - 1].rtp += hitFrequency * paytable[hits - 1];
    }
    return data;
};