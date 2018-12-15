const shuffle = require('shuffle-array');

module.exports = config => {
    const reels = [];
    for (let i = 0; i < config.size.reels; ++i) {
        reels.push([]);
    }
    // Set reels data structure
    for (let i = 0; i < config.size.reels; ++i) {
        for (let j = 0; j < config.wildSymbol.occurrences[i]; ++j) {
            reels[i].push(config.wildSymbol.id);
        }
    }
    for (let i = 0; i < config.size.reels; ++i) {
        for (let j = 0; j < config.bonusSymbol.occurrences[i]; ++j) {
            reels[i].push(config.bonusSymbol.id);
        }
    }
    for (let i = 0; i < config.size.reels; ++i) {
        for (let j = 0; j < config.freeSpinsSymbol.occurrences[i]; ++j) {
            reels[i].push(config.freeSpinsSymbol.id);
        }
    }
    for (const symbol of config.symbols) {
        for (let i = 0; i < config.size.reels; ++i) {
            for (let j = 0; j < symbol.occurrences[i]; ++j) {
                reels[i].push(symbol.id);
            }
        }
    }
    // Shuffle reels
    for (const reel of reels) {
        shuffle(reel);
        // Make sure bonus and free spins symbols are at least (row - 1) spaces apart
        // Also, wild symbols should be at least (row - 1) spaces apart from each other
        while (!checkSymbols(reel, [config.bonusSymbol.id, config.freeSpinsSymbol.id], config.size.rows - 1) || !checkSymbol(reel, config.wildSymbol.id, config.size.rows - 1)) {
            shuffle(reel);
        }
    }
    return reels;
};

const getAllIndice = (array, value) => {
    const indice = [];
    let index = -1;
    while ((index = array.indexOf(value, index + 1)) !== -1) {
        indice.push(index);
    }
    return indice;
};

const checkSymbols = (reel, symbols, minimumSpacesBetween) => {
    let indice = [];
    for (let symbol of symbols) {
        indice = [...indice, ...getAllIndice(reel, symbol)];
    }
    indice.sort((a, b) => a > b ? 1 : -1);
    if (indice.length === 0) {
        return true;
    }
    for (let i = 0; i < indice.length - 1; ++i) {
        const currentIndex = indice[i];
        const nextIndex = indice[(i + 1) % indice.length];
        if (nextIndex - currentIndex <= minimumSpacesBetween) {
            return false;
        }
    }
    const firstIndex = indice[0];
    const lastIndex = indice[indice.length - 1];
    if (firstIndex + reel.length - lastIndex <= minimumSpacesBetween) {
        return false;
    }
    return true;
}

const checkSymbol = (reel, symbol, minimumSpacesBetween) => {
    const indice = getAllIndice(reel, symbol);
    if (indice.length === 0) {
        return true;
    }
    for (let i = 0; i < indice.length - 1; ++i) {
        const currentIndex = indice[i];
        const nextIndex = indice[(i + 1) % indice.length];
        if (nextIndex - currentIndex <= minimumSpacesBetween) {
            return false;
        }
    }
    const firstIndex = indice[0];
    const lastIndex = indice[indice.length - 1];
    if (firstIndex + reel.length - lastIndex <= minimumSpacesBetween) {
        return false;
    }
    return true;
};