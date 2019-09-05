//bord
(function(){
    var row = 10;
    var colum = 10;
    var width = 50;
    var top = 0;
    var links = 0;
    //spelers
    var gameBoardPlayer = document.getElementById("grid-myplayer");
    var gameBoardEnemy = document.getElementById("grid-enemyplayer");
    const availableShips = ['Patrol Boat', 'Destroyer', 'Cruiser', 'Battleship', 'Carrier' ];
    function Game(){
        DrawGrids();
    }
    
    let board = new Array(100).fill(null);
    console.log(board);
    function DrawGrids(){
        for (let i = 1; i <= 100; i++) {
            var cell = document.createElement("div")
            cell.classList.add('cell-'+i);
            gameBoardPlayer.appendChild(cell);
        }
        
        for (let i = 1; i <= 100; i++) {
            var cell = document.createElement("div")
            cell.classList.add('cell-'+i);
            gameBoardEnemy.appendChild(cell);
        }
    }

    Game.prototype.Rosterlistener{
        ;
    }
 function Ship(type, playerGrid, player){
    this.damage = 0;
	this.type = type;
	this.playerGrid = playerGrid;
    this.player = player;
    switch(this.type){
        case CONST.AVAILABLE_SHIPS[0]:
			this.shipLength = 2;
			break;
		case CONST.AVAILABLE_SHIPS[1]:
			this.shipLength = 3;
			break;
		case CONST.AVAILABLE_SHIPS[2]:
			this.shipLength = 3;
			break;
		case CONST.AVAILABLE_SHIPS[3]:
			this.shipLength = 4;
			break;
		case CONST.AVAILABLE_SHIPS[4]:
			this.shipLength = 5;
			break;
		default:
			this.shipLength = 3;
            break;
        
    }
    this.maxDamage = this.shipLength;
	this.sunk = false;


 }   
    var mainGame = new Game();
})();
