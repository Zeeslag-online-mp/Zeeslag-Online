var row = 10;
var colum = 10;
var width = 50;
var top = 0;
var links = 0;
//spelers
var gameBoardPlayer = document.getElementById("grid-myplayer");
var gameBoardEnemy = document.getElementById("grid-enemyplayer");
var block = document.getElementById("patreonboat");

//bord spel
let board = new Array(100).fill(null);
console.log(board);

for (let i = 1; i <= 100; i++) {
    var cell = document.createElement("div")
    gameBoardPlayer.appendChild(cell);
    cell.id = 's' + i;

}

for (let i = 1; i <= 100; i++) {
        var cell = document.createElement("div")
        gameBoardEnemy.appendChild(cell);
        cell.id = 's' + i;

}

function changecolor(){
    document.body.style.color = "purple";
    return false;
}
