const mjmlToHTML = require('mjml');
var j = process.argv[2];
var data = mjmlToHTML(j, {minify: true});
console.log('hiii');
console.log(JSON.stringify(data));

