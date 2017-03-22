try {

    console.log("started...");

    var app = require('express')();
    var server = require('http').Server(app);
    var io = require('socket.io')(server);
    var redis = require('redis');

    server.listen(8890);

    console.log("initiated...");
    io.on('connection', function (socket) {

        console.log("a new user connected.");

        var channelName = socket.handshake.query.channel;

        console.log("channelName: " + channelName);

        var redisClient = redis.createClient();
        redisClient.subscribe(channelName);

        console.log("user subscribed.");


        redisClient.on("message", function (channel, message) {
            socket.send(message);
        });

        socket.on('disconnect', function () {
            console.log("user disconnected.");
            redisClient.quit();
        });

    });
} catch (error) {
    console.log('error: ' + error);
}
