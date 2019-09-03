(function() {
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
	function Game(size){
		Game.size = size;
		this.createGrid();
			this.init();
	
	}
	function Grid(size) {
		this.size = size;
		this.cells = [];
		this.init();
	}

	Game.size = 10;
// initialiseerd de grid
Grid.prototype.init = function() {
	for (var x = 0; x < this.size; x++) {
		var row = [];
		this.cells[x] = row;
		for (var y = 0; y < this.size; y++) {
			row.push(CONST.TYPE_EMPTY);
		}
	}
};
Game.prototype.createGrid = function() {
	var gridDiv = document.querySelectorAll('.grid');
	for (var grid = 0; grid < gridDiv.length; grid++) {
		gridDiv[grid].removeChild(gridDiv[grid].querySelector('.no-js')); // Removes the no-js warning
		for (var i = 0; i < Game.size; i++) {
			for (var j = 0; j < Game.size; j++) {
				var el = document.createElement('div');
				el.setAttribute('data-x', i);
				el.setAttribute('data-y', j);
				el.setAttribute('class', 'grid-cell grid-cell-' + i + '-' + j);
				gridDiv[grid].appendChild(el);
			}
		}
	}
};

Game.prototype.init = function(){
	this.humanGrid = new Grid(Game.size);
	this.enemyGrid = new Grid(Game.size);
	

	var rotateButton = document.getElementById('rotate-button');
	rotateButton.addEventListener('click', this.toggleRotation, false);
	var startButton = document.getElementById('start-game');
	startButton.self = this;
	startButton.addEventListener('click', this.startGame, false);
} 


	

var mainGame = new Game(10);

})();