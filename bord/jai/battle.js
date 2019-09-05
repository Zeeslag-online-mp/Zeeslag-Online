//bord
var row = 10;
var colum = 10;
var width = 50;
var top = 0;
var links = 0;
//spelers
var gameBoardPlayer = document.getElementById("grid-myplayer");
var gameBoardEnemy = document.getElementById("grid-enemyplayer");


let board = new Array(100).fill(null);
console.log(board);

for (let i = 1; i <= 100; i++) {
    var cell = document.createElement("div")
    cell.classList.add('cell-'+i);
    gameBoardPlayer.appendChild(cell);
}

//maakt het bord
// for(i = 0; i < colum; i++)
//  {
//      for(j = 0; j < row; j++)
//      {
//          var vierkant = document.createElement("div");
//          gameBoardEnemy.appendChild(vierkant);

//          vierkant.id = 's' + j + i;

//          top += j * width;
//          links += i * width;

//          vierkant.style.top += top + 'px';
//          vierkant.style.left += links + 'px';
//      }
//  }