const config = require('./combination-config');
const combinationToData = require('./../modules/calculation/combination-to-data');
const fileToJson = require('../modules/io/file-to-json');
const jsonToFile = require('../modules/io/json-to-file');

console.log('');
const games = {};
for (const game of Object.entries(config)) {
    const [key, value] = game;
    const reels = JSON.parse(fileToJson(`${value.config.name}-reels`));
    const bonus3 = value.bonus3 ? JSON.parse(fileToJson(`${value.bonus3.name}-reels`)) : [[]];
    const bonus4 = value.bonus4 ? JSON.parse(fileToJson(`${value.bonus4.name}-reels`)) : [[]];
    const bonus5 = value.bonus5 ? JSON.parse(fileToJson(`${value.bonus4.name}-reels`)) : [[]];
    const bonus = [[], [], bonus3[0], bonus4[0], bonus5[0]];
    const freeSpins = value.freeSpins ? JSON.parse(fileToJson(`${value.freeSpins.name}-reels`)).map(freeSpin => freeSpin[0][0]) : [0, 0, 0, 0, 0];
    games[key] = {
        config: value.config,
        reels,
        bonus,
        freeSpins
    };
}

console.log('');
process.argv.slice(2).forEach(arg => {
    jsonToFile(combinationToData({ ...games[arg] }), `${games[arg].config.name}-combination`);
    console.log('');
});

