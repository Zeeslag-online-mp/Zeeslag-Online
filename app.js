var express = require('express') ;
var app = express();
var serv = require('http').Server(app);


app.get('/',function(req, res) {
    res.sendFile(__dirname + '/client/index.html');
});
app.use('/client',express.static(__dirname + '/client'));

serv.listen(2000);
console.log('server started');

var io = require('socket.io') (serv,{});
io.sockets.on('connection', function(socket){
    console.log('socket connection');

    socket.on('happy',function(data){
        console.log('happy because' + data.reason);
    });
        
    

});


var CONST = {};
CONST.AVAILABLE_SHIPS = ['carrier', 'battleship', 'destroyer', 'submarine', 'patrolboat'];
CONST.Human_Player = 0;
CONST.Enemy_player = 1;
//value for parameter type (string)
CONST.CSS_TYPE_EMPTY = 'empty';
CONST.CSS_TYPE_SHIP = 'ship';
CONST.CSS_TYPE_MISS = 'miss';
CONST.CSS_TYPE_HIT = 'hit';
CONST.CSS_TYPE_SUNK = 'sunk';
//Grid code
CONST.TYPE_EMPTY = 0; // 0 = water (empty)
CONST.TYPE_SHIP = 1; // 1 = undamaged ship
CONST.TYPE_MISS = 2; // 2 = water with a cannonball in it (missed shot)
CONST.TYPE_HIT = 3; // 3 = damaged ship (hit shot)
CONST.TYPE_SUNK = 4; // 4 = sunk ship
//these numbers correspomd to CONST.AVAILABLE_SHIPS
// 0) 'carrier' 1) 'battleship' 2) 'destroyer' 3) 'submarine' 4) 'patrolboat'
Game.usedShips = [CONST.UNUSED, CONST.UNUSED, CONST.UNUSED, CONST.UNUSED, CONST.UNUSED];
CONST.USED = 1;
CONST.UNUSED = 0;
