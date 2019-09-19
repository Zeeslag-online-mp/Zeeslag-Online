
//bord
console.log(interact)

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


/* =====================
 * PLACING BOATS
 * ===================== */ 


//bord spel
let board = new Array(100).fill(null);
console.log(board);

/*for (let i = 1; i <= 100; i++) {
    var cell = document.createElement("div")
    gameBoardPlayer.appendChild(cell);
    cell.id = 's' + i;

}

for (let i = 1; i <= 100; i++) {
        var cell = document.createElement("div")
        gameBoardEnemy.appendChild(cell);
        cell.id = 's' + i;

}*/

createShip();
DrawGrids();
function createShip(){

  var element = document.getElementById('boat');
  var x = 0;
  var y = 0;
  interact(element) 
  .draggable(
  {
    modifiers: [
      interact.modifiers.snap({
        targets: [
          interact.createSnapGrid({ x: 50, y: 50 })
        ],
        range: Infinity,
        relativePoints: [ { x: 0, y: 0 } ]
      }),
      interact.modifiers.restrict({
        restriction: element.parentNode,
        elementRect: { top: 0, left: 0, bottom: 1, right: 1 },
        endOnly: true
      })
    ],
    onmove:dragMoveListener,
    inertia: true
  })
  .on('dragmove', function (event) {

      x += event.dx
      y += event.dy

      event.target.style.webkitTransform =
      event.target.style.transform =
      'translate(' + x + 'px, ' + y + 'px)'
  })

}



function dragMoveListener (event) {
  var target = event.target
  // keep the dragged position in the data-x/data-y attributes
  var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx
  var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy

  // translate the element
  target.style.webkitTransform =
    target.style.transform =
      'translate(' + x + 'px, ' + y + 'px)'

  // update the posiion attributes
  target.setAttribute('data-x', x)
  target.setAttribute('data-y', y)
}

  

 




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
        cell.classList = 'data-x' + i;
    
    }
    
    for (let i = 1; i <= 100; i++) {
            var cell = document.createElement("div")
           
           
            gameBoardEnemy.appendChild(cell);
            cell.classList = 'tap-target data-x';
            cell.id =  'cell-' + i;
            
    
    }
 
}

function changeColor(evt){
    
  

  }
gameBoardEnemy.addEventListener('click', clickOnGrid());


