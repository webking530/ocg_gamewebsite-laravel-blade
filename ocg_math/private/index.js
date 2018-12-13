// const config = require('./config/original/the-fruits-config');
// const config = require('./config/original/space-adventure-config');
// const config = require('./config/original/arabian-nights-config');
// const config = require('./config/original/arabian-nights-free-spins-config');
const config = require('./config/test');

const configToOptions = require('./../modules/data/config-to-options');
const optionsToMath = require('./../modules/data/options-to-math');
const configToReels = require('./../modules/data/config-to-reels');

const monteCarloSimulation = require('./../modules/simulation/monte-carlo-simulation');
const fullSimulation = require('./../modules/simulation/full-simulation');

const jsonToFile = require('./../modules/io/json-to-file');
const fileToJson = require('./../modules/io/file-to-json');

const options = configToOptions(config);
jsonToFile(options, `${config.name}-options`);
const math = optionsToMath(options);
jsonToFile(math, `${config.name}-math`);
console.log('**************************');
console.log('********** MATH **********');
console.log('**************************');
// console.log('');
// console.log(math.symbols);
// console.log('');
// console.log(math.bonus);
// console.log('');
// console.log(math.freeSpins);
console.log('');
console.log(math.total);
console.log('');
const reels = configToReels(config);
jsonToFile(reels, `${config.name}-reels`);
const monteCarloResults = monteCarloSimulation({ config, reels });
jsonToFile(monteCarloResults, `${config.name}-monteCarloResults`);
console.log('*******************************************');
console.log('********** RESULTS (MONTE CARLO) **********');
console.log('*******************************************');
console.log('');
console.log(monteCarloResults.total);
console.log('');
console.log(monteCarloResults.wins);
console.log('');
const fullResults = fullSimulation({ options, reels });
jsonToFile(fullResults, `${config.name}-fullResults`);
console.log('************************************');
console.log('********** RESULTS (FULL) **********');
console.log('************************************');
console.log('');
console.log(fullResults.total);
console.log('');
console.log(fullResults.wins);
console.log('');

/**
 * Combination:
 *  Array of symbol rows
 *  Ex: [ [1, 2, 3, 4, 5], [1, 2, 3, 4, 5], [1, 2, 3, 4, 5] ]
 * 
 * Win:
 *  Array of win lines:
 *      amount - Line coefficient => paytable[symbol][hits]
 *      line - Line ID => index + 1
 *      list - Array of win symbols: { row, col, value }
 *      num_win - Number of win symbols
 *      value - Win symbol
 *  Ex: [ {}, ... ]
 */