
//bord
(function(){
  import interact from 'interactjs';
var row = 10;
var colum = 10;
var width = 50;
var top = 0;
var links = 0;
//spelers
var gameBoardPlayer = document.getElementById("grid-myplayer");
var gameBoardEnemy = document.getElementById("grid-enemyplayer");
var block = document.getElementById("");




function clickOnGrid(){
    interact('.tap-target')
.on('tap', function (event) {
  event.currentTarget.classList.toggle('switch-bg')
  event.preventDefault()
})
}



//bord spel






    // Global Constants
var CONST = {};
CONST.AVAILABLE_SHIPS = ['carrier', 'battleship', 'destroyer', 'submarine', 'patrolboat'];
// You are player 0 and the  is player 1
// The virtual player is used for generating temporary ships
// for calculating the probability heatmap
CONST.HUMAN_PLAYER = 0;
CONST.VIRTUAL_PLAYER = 2;
// Possible values for the parameter `type` (string)
CONST.CSS_TYPE_EMPTY = 'empty';
CONST.CSS_TYPE_SHIP = 'ship';
CONST.CSS_TYPE_MISS = 'miss';
CONST.CSS_TYPE_HIT = 'hit';
CONST.CSS_TYPE_SUNK = 'sunk';
// Grid code:
CONST.TYPE_EMPTY = 0; // 0 = water (empty)
CONST.TYPE_SHIP = 1; // 1 = undamaged ship
CONST.TYPE_MISS = 2; // 2 = water with a cannonball in it (missed shot)
CONST.TYPE_HIT = 3; // 3 = damaged ship (hit shot)
CONST.TYPE_SUNK = 4; // 4 = sunk ship



CONST.USED = 1;
CONST.UNUSED = 0;
    

function DrawGrids(){
    for (let i = 1; i <= 100; i++) {
        var cell = document.createElement("div")
        gameBoardPlayer.appendChild(cell);
        cell.id = 'cell-' + i;
    
    }
    
    for (let i = 1; i <= 100; i++) {
            var cell = document.createElement("div")
            gameBoardEnemy.appendChild(cell);
            cell.id = 'cell-' + i;
    
    }
}
function changeColor(evt){
    
  

  }
gameBoardEnemy.addEventListener('click', changeColor());
DrawGrids();

})();
