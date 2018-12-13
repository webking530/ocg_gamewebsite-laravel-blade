const configToOptions = require('../modules/data/config-to-options');
const optionsToMath = require('../modules/data/options-to-math');
const configToReels = require('../modules/data/config-to-reels');
const jsonToFile = require('../modules/io/json-to-file');

console.log('');
process.argv.slice(2).forEach(arg => {
    const config = require(`./config/${arg}`);
    console.log(`Generating:\t${config.name}`);
    console.log(`Statistics:\t${JSON.stringify(optionsToMath(configToOptions(config)).total)}`);
    jsonToFile(configToReels(config), `${config.name}-reels`);
    console.log('');
});