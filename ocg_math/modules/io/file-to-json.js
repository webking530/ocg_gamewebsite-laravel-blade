const fs = require('fs');

module.exports = (file) => {
    console.log(`LOADING FROM FILE - ${file}.json`);
    return fs.readFileSync(`./export/${file}.json`, `utf-8`);
};