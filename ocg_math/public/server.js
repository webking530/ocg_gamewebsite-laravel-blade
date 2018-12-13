const http = require('http');

const config = require('./server-config');
const fileToJson = require('../modules/io/file-to-json');
const combinationToData = require('./../modules/calculation/combination-to-data');

console.log('');
console.log('INITIATING SERVER...');
console.log('');
console.log('Loading games...');
const games = {};
for (const game of Object.entries(config.games)) {
    const [key, value] = game;
    const reels = JSON.parse(fileToJson(`${value.config.name}-reels`));
    const bonus3 = value.bonus3 ? JSON.parse(fileToJson(`${value.bonus3.name}-reels`)) : [[]];
    const bonus4 = value.bonus4 ? JSON.parse(fileToJson(`${value.bonus4.name}-reels`)) : [[]];
    const bonus5 = value.bonus5 ? JSON.parse(fileToJson(`${value.bonus4.name}-reels`)) : [[]];
    const bonus = [[], [], bonus3[0], bonus4[0], bonus5[0]];
    const freeSpins = value.freeSpins ? JSON.parse(fileToJson(`${value.config.name}-reels`)).map(freeSpin => freeSpin[0][0]) : [0, 0, 0, 0, 0];
    games[key] = {
        config: value.config,
        reels,
        bonus,
        freeSpins
    };
}
console.log('Games loaded');
console.log('');
console.log('Starting server...');
const server = http.createServer((req, res) => {
    const response = {
        Result: true,
        ErrorOccured: false,
        ExceptionMessage: ''
    }
    try {
        const params = getParams(req);
        if (!params.game || !games[params.game]) {
            throw new Error('Invalid game');
        }
        const game = games[params.game];
        if (!params.lines || params.lines <= 0 || params.lines > game.config.paylines.length) {
            throw new Error('Invalid lines');
        }
        response.Result = combinationToData({
            ...game,
            lines: params.lines
        });
    } catch (e) {
        response.Result = false;
        response.ErrorOccured = true;
        response.ExceptionMessage = e.stack;
    }
    res.end(JSON.stringify(response));
});
const getParams = req => {
    const q = req.url.split('?'), result = {};
    if (q.length >= 2) {
        q[1].split('&').forEach((item) => {
            try {
                result[item.split('=')[0]] = item.split('=')[1];
            } catch (e) {
                result[item.split('=')[0]] = '';
            }
        })
    }
    return result;
};
server.listen(config.port);
console.log(`Server started on port ${config.port}`);
console.log('');
console.log('SERVER INITIATED');
console.log(`\tPort: ${config.port}`);
console.log(`\tGames: ${JSON.stringify(Object.keys(games))}`);
console.log('');