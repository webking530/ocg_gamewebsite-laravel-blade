module.exports = config => {
    const options = { ...config };
    // Set number of symbols per reel
    options.reels = new Array(options.size.reels).fill(0);
    for (const symbol of options.symbols) {
        for (let i = 0; i < options.size.reels; ++i) {
            options.reels[i] += symbol.occurrences[i];
        }
    }
    for (let i = 0; i < options.size.reels; ++i) {
        options.reels[i] += options.wildSymbol.occurrences[i];
        options.reels[i] += options.bonusSymbol.occurrences[i];
        options.reels[i] += options.freeSpinsSymbol.occurrences[i];
    }
    // Set symbol occurrence chances per reel
    for (const symbol of options.symbols) {
        symbol.occurrenceChances = [];
        for (let i = 0; i < options.size.reels; ++i) {
            symbol.occurrenceChances.push(symbol.occurrences[i] / options.reels[i]);
        }
    }
    options.wildSymbol.occurrenceChances = [];
    options.bonusSymbol.occurrenceChances = [];
    options.freeSpinsSymbol.occurrenceChances = [];
    for (let i = 0; i < options.size.reels; ++i) {
        options.wildSymbol.occurrenceChances.push(options.wildSymbol.occurrences[i] / options.reels[i]);
        // Bonus and free spins symbol occurrence chances take (rows - 1) more occurences
        options.bonusSymbol.occurrenceChances.push(options.bonusSymbol.occurrences[i] * (1 + (options.size.rows - 1)) / options.reels[i]);
        options.freeSpinsSymbol.occurrenceChances.push(options.freeSpinsSymbol.occurrences[i] * (1 + (options.size.rows - 1)) / options.reels[i]);
    }
    return options;
};