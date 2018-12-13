const fs = require('fs');

module.exports = (json, file) => {
    console.log(`SAVING TO FILE - ${file}.json`);
    if (!fs.existsSync('./export')) {
        fs.mkdirSync('./export');
    }
    fs.writeFileSync(`./export/${file}.json`, JSON.stringify(json, null, `\t`));
    console.log('FILE SAVED!');
};