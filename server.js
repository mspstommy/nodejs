var http = require("http");
var fs = require("fs");
http.createServer(function(request, response) {
  response.writeHead(200, {"Content-Type": "text/plain"});
  fs.readFile('input.txt', function (err, data) {
    if (err) {
        return console.error(err);
    }
    console.log("異步讀取: " + data.toString());
 });
  response.write("Hello World");
  response.end();
}).listen(8888);