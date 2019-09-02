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

	// Game Statistics
function Stats(){
	this.shotsTaken = 0;
	this.shotsHit = 0;
	this.totalShots = parseInt(localStorage.getItem('totalShots'), 10) || 0;
	this.totalHits = parseInt(localStorage.getItem('totalHits'), 10) || 0;
	this.gamesPlayed = parseInt(localStorage.getItem('gamesPlayed'), 10) || 0;
	this.gamesWon = parseInt(localStorage.getItem('gamesWon'), 10) || 0;
	this.uuid = localStorage.getItem('uuid') || this.createUUID();
	if (DEBUG_MODE) {
		this.skipCurrentGame = true;
	}
}
Stats.prototype.incrementShots = function() {
	this.shotsTaken++;
};
Stats.prototype.hitShot = function() {
	this.shotsHit++;
};
Stats.prototype.wonGame = function() {
	this.gamesPlayed++;
	this.gamesWon++;
	if (!DEBUG_MODE) {
		ga('send', 'event', 'gameOver', 'win', this.uuid);
	}
};
Stats.prototype.lostGame = function() {
	this.gamesPlayed++;
	if (!DEBUG_MODE) {
		ga('send', 'event', 'gameOver', 'lose', this.uuid);
	}
};
// Saves the game statistics to localstorage, also uploads where the user placed
// their ships to Google Analytics so that in the future I'll be able to see
// which cells humans are disproportionately biased to place ships on.
Stats.prototype.syncStats = function() {
	if(!this.skipCurrentGame) {
		var totalShots = parseInt(localStorage.getItem('totalShots'), 10) || 0;
		totalShots += this.shotsTaken;
		var totalHits = parseInt(localStorage.getItem('totalHits'), 10) || 0;
		totalHits += this.shotsHit;
		localStorage.setItem('totalShots', totalShots);
		localStorage.setItem('totalHits', totalHits);
		localStorage.setItem('gamesPlayed', this.gamesPlayed);
		localStorage.setItem('gamesWon', this.gamesWon);
		localStorage.setItem('uuid', this.uuid);
	} else {
		this.skipCurrentGame = false;
	}
	
	var stringifiedGrid = '';
	for (var x = 0; x < Game.size; x++) {
		for (var y = 0; y < Game.size; y++) {
			stringifiedGrid += '(' + x + ',' + y + '):' + mainGame.humanGrid.cells[x][y] + ';\n';
		}
	}

	if (!DEBUG_MODE) {
		ga('send', 'event', 'humanGrid', stringifiedGrid, this.uuid);
	}
};
// Updates the sidebar display with the current statistics
Stats.prototype.updateStatsSidebar = function() {
	var elWinPercent = document.getElementById('stats-wins');
	var elAccuracy = document.getElementById('stats-accuracy');
	elWinPercent.innerHTML = this.gamesWon + " of " + this.gamesPlayed;
	elAccuracy.innerHTML = Math.round((100 * this.totalHits / this.totalShots) || 0) + "%";
};
// Reset all game vanity statistics to zero. Doesn't reset your uuid.
Stats.prototype.resetStats = function(e) {
	// Skip tracking stats until the end of the current game or else
	// the accuracy percentage will be wrong (since you are tracking
	// hits that didn't start from the beginning of the game)
	Game.stats.skipCurrentGame = true;
	localStorage.setItem('totalShots', 0);
	localStorage.setItem('totalHits', 0);
	localStorage.setItem('gamesPlayed', 0);
	localStorage.setItem('gamesWon', 0);
	localStorage.setItem('showTutorial', true);
	Game.stats.shotsTaken = 0;
	Game.stats.shotsHit = 0;
	Game.stats.totalShots = 0;
	Game.stats.totalHits = 0;
	Game.stats.gamesPlayed = 0;
	Game.stats.gamesWon = 0;
	Game.stats.updateStatsSidebar();
};
	function Game(size) {
		Game.size = size;
		this.shotsTaken = 0;
		this.createGrid();
		this.init();
	}
	
	Game.size = 10; // Default grid size is 10x10
	Game.gameOver = false;
	
	Game.prototype.checkIfWon = function() {
		if (this.enemyFleet.allShipsSunk()) {
			alert('Congratulations, you win!');
			Game.gameOver = true;
			Game.stats.wonGame();
			Game.stats.syncStats();
			Game.stats.updateStatsSidebar();
			this.showRestartSidebar();
		} else if (this.humanFleet.allShipsSunk()) {
			alert('Yarr! The enemy sank all your ships. Try again.');
			Game.gameOver = true;
			Game.stats.lostGame();
			Game.stats.syncStats();
			Game.stats.updateStatsSidebar();
			this.showRestartSidebar();
		}
	}
	// Shoots at the target player on the grid.
// Returns {int} Constants.TYPE: What the shot uncovered
Game.prototype.shoot = function(x, y, targetPlayer) {
	var targetGrid;
	var targetFleet;
	if (targetPlayer === CONST.HUMAN_PLAYER) {
		targetGrid = this.humanGrid;
		targetFleet = this.humanFleet;
	} else if (targetPlayer === CONST.COMPUTER_PLAYER) {
		targetGrid = this.enemyGrid;
		targetFleet = this.computerFleet;
	} else {
		// Should never be called
		console.log("There was an error trying to find the correct player to target");
	}

	if (targetGrid.isDamagedShip(x, y)) {
		return null;
	} else if (targetGrid.isMiss(x, y)) {
		return null;
	} else if (targetGrid.isUndamagedShip(x, y)) {
		// update the board/grid
		targetGrid.updateCell(x, y, 'hit', targetPlayer);
		// IMPORTANT: This function needs to be called _after_ updating the cell to a 'hit',
		// because it overrides the CSS class to 'sunk' if we find that the ship was sunk
		targetFleet.findShipByCoords(x, y).incrementDamage(); // increase the damage
		this.checkIfWon();
		return CONST.TYPE_HIT;
	} else {
		targetGrid.updateCell(x, y, 'miss', targetPlayer);
		this.checkIfWon();
		return CONST.TYPE_MISS;
	}
};
// Creates click event listeners on each one of the 100 grid cells
Game.prototype.shootListener = function(e) {
	var self = e.target.self;
	// Extract coordinates from event listener
	var x = parseInt(e.target.getAttribute('data-x'), 10);
	var y = parseInt(e.target.getAttribute('data-y'), 10);
	var result = null;
	if (self.readyToPlay) {
		result = self.shoot(x, y, CONST.COMPUTER_PLAYER);

		// Remove the tutorial arrow
		if (gameTutorial.showTutorial) {
			gameTutorial.nextStep();
		}
	}

	if (result !== null && !Game.gameOver) {
		Game.stats.incrementShots();
		if (result === CONST.TYPE_HIT) {
			Game.stats.hitShot();
		}
		// If enemy shoots
	} else {
		Game.gameOver = false;
	}
};
/*
================================================================================================================
BATIN
===========================================================================================================


wat moet er hier gebeuren?
 de namen van de schepen moeten aangeklikt worden en dan op het bord geplaatst worden 
 denk aan:
 het aanklikken van de naam van het schip dat je de grote van het schip op jou bord kan zien en ook neer kan zetten 
 dat je niet een schip op andere schepen kan plaatsen dus 
 "isLegal" zo heb ik er alvast ingezet de rest zit er al zo in dan komt alleen nog het online gedeelte maar dat moet aboker doen 
*/

// Click handler for the Rotate Ship button
Game.prototype.toggleRotation = function(e) {
	// Toggle rotation direction
	var direction = parseInt(e.target.getAttribute('data-direction'), 10);
	if (direction === Ship.DIRECTION_VERTICAL) {
		e.target.setAttribute('data-direction', '1');
		Game.placeShipDirection = Ship.DIRECTION_HORIZONTAL;
	} else if (direction === Ship.DIRECTION_HORIZONTAL) {
		e.target.setAttribute('data-direction', '0');
		Game.placeShipDirection = Ship.DIRECTION_VERTICAL;
	}
};
// Click handler for the Start Game button
Game.prototype.startGame = function(e) {
	var self = e.target.self;
	var el = document.getElementById('roster-sidebar');
	var fn = function() {el.setAttribute('class', 'hidden');};
	el.addEventListener(transitionEndEventName(),fn,false);
	el.setAttribute('class', 'invisible');
	self.readyToPlay = true;

	// Advanced the tutorial step
	if (gameTutorial.currentStep === 3) {
		gameTutorial.nextStep();
	}
	el.removeEventListener(transitionEndEventName(),fn,false);
};
// Click handler for Restart Game button
Game.prototype.restartGame = function(e) {
	e.target.removeEventListener(e.type, arguments.callee);
	var self = e.target.self;
	document.getElementById('restart-sidebar').setAttribute('class', 'hidden');
	self.resetFogOfWar();
	self.init();
};
// Debugging function used to place all ships and just start
Game.prototype.placeRandomly = function(e){
	e.target.removeEventListener(e.type, arguments.callee);
	e.target.self.humanFleet.placeShipsRandomly();
	e.target.self.readyToPlay = true;
	document.getElementById('roster-sidebar').setAttribute('class', 'hidden');
	this.setAttribute('class', 'hidden');
};
// Resets the fog of war
Game.prototype.resetFogOfWar = function() {
	for (var i = 0; i < Game.size; i++) {
		for (var j = 0; j < Game.size; j++) {
			this.humanGrid.updateCell(i, j, 'empty', CONST.Human_Player);
			this.enemyGrid.updateCell(i, j, 'empty', CONST.Enemy_player);
		}
	}
	// Reset all values to indicate the ships are ready to be placed again
	Game.usedShips = Game.usedShips.map(function(){return CONST.UNUSED;});
};
// Resets CSS styling of the sidebar
Game.prototype.resetRosterSidebar = function() {
	var els = document.querySelector('.fleet-roster').querySelectorAll('li');
	for (var i = 0; i < els.length; i++) {
		els[i].removeAttribute('class');
	}

	if (gameTutorial.showTutorial) {
		gameTutorial.nextStep();
	} else {
		document.getElementById('roster-sidebar').removeAttribute('class');
	}
	document.getElementById('rotate-button').removeAttribute('class');
	document.getElementById('start-game').setAttribute('class', 'hidden');
	if (DEBUG_MODE) {
		document.getElementById('place-randomly').removeAttribute('class');
	}
};

Game.prototype.showRestartSidebar = function() {
	var sidebar = document.getElementById('restart-sidebar');
	sidebar.setAttribute('class', 'highlight');

	// Deregister listeners
	var computerCells = document.querySelector('.computer-player').childNodes;
	for (var j = 0; j < computerCells.length; j++) {
		computerCells[j].removeEventListener('click', this.shootListener, false);
	}
	var playerRoster = document.querySelector('.fleet-roster').querySelectorAll('li');
	for (var i = 0; i < playerRoster.length; i++) {
		playerRoster[i].removeEventListener('click', this.rosterListener, false);
	}

	var restartButton = document.getElementById('restart-game');
	restartButton.addEventListener('click', this.restartGame, false);
	restartButton.self = this;
};
// Generates the HTML divs for the grid for both players
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

// Initializes the Game. Also resets the game if previously initialized
Game.prototype.init = function() {
	this.humanGrid = new Grid(Game.size);
	this.enemyGrid = new Grid(Game.size);
	this.humanFleet = new Fleet(this.humanGrid, CONST.Enemy_player);
	this.enemyFleet = new Fleet(this.enemyGrid, CONST.Enemy_player);

	
	Game.stats = new Stats();
	Game.stats.updateStatsSidebar();

	// Reset game variables
	this.shotsTaken = 0;
	this.readyToPlay = false;
	this.placingOnGrid = false;
	Game.placeShipDirection = 0;
	Game.placeShipType = '';
	Game.placeShipCoords = [];

	this.resetRosterSidebar();

	// Add a click listener for the Grid.shoot() method for all cells
	// Only add this listener to the computer's grid
	var enemyCells = document.querySelector('.enemy-player').childNodes;
	for (var j = 0; j < computerCells.length; j++) {
		enemyCells[j].self = this;
		enemyCells[j].addEventListener('click', this.shootListener, false);
	}

	// Add a click listener to the roster	
	var playerRoster = document.querySelector('.fleet-roster').querySelectorAll('li');
	for (var i = 0; i < playerRoster.length; i++) {
		playerRoster[i].self = this;
		playerRoster[i].addEventListener('click', this.rosterListener, false);
	}

	// Add a click listener to the human player's grid while placing
	var humanCells = document.querySelector('.human-player').childNodes;
	for (var k = 0; k < humanCells.length; k++) {
		humanCells[k].self = this;
		humanCells[k].addEventListener('click', this.placementListener, false);
		humanCells[k].addEventListener('mouseover', this.placementMouseover, false);
		humanCells[k].addEventListener('mouseout', this.placementMouseout, false);
	}

	var rotateButton = document.getElementById('rotate-button');
	rotateButton.addEventListener('click', this.toggleRotation, false);
	var startButton = document.getElementById('start-game');
	startButton.self = this;
	startButton.addEventListener('click', this.startGame, false);
	var resetButton = document.getElementById('reset-stats');
	resetButton.addEventListener('click', Game.stats.resetStats, false);
	var randomButton = document.getElementById('place-randomly');
	randomButton.self = this;
	randomButton.addEventListener('click', this.placeRandomly, false);
	this.enemyFleet.placeShipsRandomly();
};

// Grid object
// Constructor
function Grid(size) {
	this.size = size;
	this.cells = [];
	this.init();
}

// Initialize and populate the grid
Grid.prototype.init = function() {
	for (var x = 0; x < this.size; x++) {
		var row = [];
		this.cells[x] = row;
		for (var y = 0; y < this.size; y++) {
			row.push(CONST.TYPE_EMPTY);
		}
	}
};

// Updates the cell's CSS class based on the type passed in
Grid.prototype.updateCell = function(x, y, type, targetPlayer) {
	var player;
	if (targetPlayer === CONST.HUMAN_PLAYER) {
		player = 'human-player';
	} else if (targetPlayer === CONST.Enemy_player) {
		player = 'enemy-player';
	} else {
		// Should never be called
		console.log("There was an error trying to find the correct player's grid");
	}

	switch (type) {
		case CONST.CSS_TYPE_EMPTY:
			this.cells[x][y] = CONST.TYPE_EMPTY;
			break;
		case CONST.CSS_TYPE_SHIP:
			this.cells[x][y] = CONST.TYPE_SHIP;
			break;
		case CONST.CSS_TYPE_MISS:
			this.cells[x][y] = CONST.TYPE_MISS;
			break;
		case CONST.CSS_TYPE_HIT:
			this.cells[x][y] = CONST.TYPE_HIT;
			break;
		case CONST.CSS_TYPE_SUNK:
			this.cells[x][y] = CONST.TYPE_SUNK;
			break;
		default:
			this.cells[x][y] = CONST.TYPE_EMPTY;
			break;
	}
	var classes = ['grid-cell', 'grid-cell-' + x + '-' + y, 'grid-' + type];
	document.querySelector('.' + player + ' .grid-cell-' + x + '-' + y).setAttribute('class', classes.join(' '));
};
// Checks to see if a cell contains an undamaged ship
// Returns boolean
Grid.prototype.isUndamagedShip = function(x, y) {
	return this.cells[x][y] === CONST.TYPE_SHIP;
};
// Checks to see if the shot was missed. This is equivalent
// to checking if a cell contains a cannonball
// Returns boolean
Grid.prototype.isMiss = function(x, y) {
	return this.cells[x][y] === CONST.TYPE_MISS;
};
// Checks to see if a cell contains a damaged ship,
// either hit or sunk.
// Returns boolean
Grid.prototype.isDamagedShip = function(x, y) {
	return this.cells[x][y] === CONST.TYPE_HIT || this.cells[x][y] === CONST.TYPE_SUNK;
};

// Fleet object
// This object is used to keep track of a player's portfolio of ships
// Constructor
function Fleet(playerGrid, player) {
	this.numShips = CONST.AVAILABLE_SHIPS.length;
	this.playerGrid = playerGrid;
	this.player = player;
	this.fleetRoster = [];
	this.populate();
}
// Populates a fleet
Fleet.prototype.populate = function() {
	for (var i = 0; i < this.numShips; i++) {
		// loop over the ship types when numShips > Constants.AVAILABLE_SHIPS.length
		var j = i % CONST.AVAILABLE_SHIPS.length;
		this.fleetRoster.push(new Ship(CONST.AVAILABLE_SHIPS[j], this.playerGrid, this.player));
	}
};
// Places the ship and returns whether or not the placement was successful
// Returns boolean
Fleet.prototype.placeShip = function(x, y, direction, shipType) {
	var shipCoords;
	for (var i = 0; i < this.fleetRoster.length; i++) {
		var shipTypes = this.fleetRoster[i].type;

		if (shipType === shipTypes &&
			this.fleetRoster[i].isLegal(x, y, direction)) {
			this.fleetRoster[i].create(x, y, direction, false);
			shipCoords = this.fleetRoster[i].getAllShipCells();

			for (var j = 0; j < shipCoords.length; j++) {
				this.playerGrid.updateCell(shipCoords[j].x, shipCoords[j].y, 'ship', this.player);
			}
			return true;
		}
	}
	return false;
};
// Places ships randomly on the board
// TODO: Avoid placing ships too close to each other
Fleet.prototype.placeShipsRandomly = function() {
	var shipCoords;
	for (var i = 0; i < this.fleetRoster.length; i++) {
		var illegalPlacement = true;
	
		// Prevents the random placement of already placed ships
		if(this.player === CONST.HUMAN_PLAYER && Game.usedShips[i] === CONST.USED) {
			continue;
		}
		while (illegalPlacement) {
			var randomX = Math.floor(Game.size * Math.random());
			var randomY = Math.floor(Game.size * Math.random());
			var randomDirection = Math.floor(2*Math.random());
			
			if (this.fleetRoster[i].isLegal(randomX, randomY, randomDirection)) {
				this.fleetRoster[i].create(randomX, randomY, randomDirection, false);
				shipCoords = this.fleetRoster[i].getAllShipCells();
				illegalPlacement = false;
			} else {
				continue;
			}
		}
		if (this.player === CONST.HUMAN_PLAYER && Game.usedShips[i] !== CONST.USED) {
			for (var j = 0; j < shipCoords.length; j++) {
				this.playerGrid.updateCell(shipCoords[j].x, shipCoords[j].y, 'ship', this.player);
				Game.usedShips[i] = CONST.USED;
			}
		}
	}
};
// Finds a ship by location
// Returns the ship object located at (x, y)
// If no ship exists at (x, y), this returns null instead
Fleet.prototype.findShipByCoords = function(x, y) {
	for (var i = 0; i < this.fleetRoster.length; i++) {
		var currentShip = this.fleetRoster[i];
		if (currentShip.direction === Ship.DIRECTION_VERTICAL) {
			if (y === currentShip.yPosition &&
				x >= currentShip.xPosition &&
				x < currentShip.xPosition + currentShip.shipLength) {
				return currentShip;
			} else {
				continue;
			}
		} else {
			if (x === currentShip.xPosition &&
				y >= currentShip.yPosition &&
				y < currentShip.yPosition + currentShip.shipLength) {
				return currentShip;
			} else {
				continue;
			}
		}
	}
	return null;
};
// Finds a ship by its type
// Param shipType is a string
// Returns the ship object that is of type shipType
// If no ship exists, this returns null.
Fleet.prototype.findShipByType = function(shipType) {
	for (var i = 0; i < this.fleetRoster.length; i++) {
		if (this.fleetRoster[i].type === shipType) {
			return this.fleetRoster[i];
		}
	}
	return null;
};
// Checks to see if all ships have been sunk
// Returns boolean
Fleet.prototype.allShipsSunk = function() {
	for (var i = 0; i < this.fleetRoster.length; i++) {
		// If one or more ships are not sunk, then the sentence "all ships are sunk" is false.
		if (this.fleetRoster[i].sunk === false) {
			return false;
		}
	}
	return true;
};

// Ship object
// Constructor
function Ship(type, playerGrid, player) {
	this.damage = 0;
	this.type = type;
	this.playerGrid = playerGrid;
	this.player = player;

	switch (this.type) {
		case CONST.AVAILABLE_SHIPS[0]:
			this.shipLength = 5;
			break;
		case CONST.AVAILABLE_SHIPS[1]:
			this.shipLength = 4;
			break;
		case CONST.AVAILABLE_SHIPS[2]:
			this.shipLength = 3;
			break;
		case CONST.AVAILABLE_SHIPS[3]:
			this.shipLength = 3;
			break;
		case CONST.AVAILABLE_SHIPS[4]:
			this.shipLength = 2;
			break;
		default:
			this.shipLength = 3;
			break;
	}
	this.maxDamage = this.shipLength;
	this.sunk = false;
}
// Increments the damage counter of a ship
// Returns Ship
Ship.prototype.incrementDamage = function() {
	this.damage++;
	if (this.isSunk()) {
		this.sinkShip(false); // Sinks the ship
	}
};
// Checks to see if the ship is sunk
// Returns boolean
Ship.prototype.isSunk = function() {
	return this.damage >= this.maxDamage;
};
// Sinks the ship
Ship.prototype.sinkShip = function(virtual) {
	this.damage = this.maxDamage; // Force the damage to exceed max damage
	this.sunk = true;

	// Make the CSS class sunk, but only if the ship is not virtual
	if (!virtual) {
		var allCells = this.getAllShipCells();
		for (var i = 0; i < this.shipLength; i++) {
			this.playerGrid.updateCell(allCells[i].x, allCells[i].y, 'sunk', this.player);
		}
	}
};
/**
 * Gets all the ship cells
 *
 * Returns an array with all (x, y) coordinates of the ship:
 * e.g.
 * [
 *	{'x':2, 'y':2},
 *	{'x':3, 'y':2},
 *	{'x':4, 'y':2}
 * ]
 */
Ship.prototype.getAllShipCells = function() {
	var resultObject = [];
	for (var i = 0; i < this.shipLength; i++) {
		if (this.direction === Ship.DIRECTION_VERTICAL) {
			resultObject[i] = {'x': this.xPosition + i, 'y': this.yPosition};
		} else {
			resultObject[i] = {'x': this.xPosition, 'y': this.yPosition + i};
		}
	}
	return resultObject;
};
// Initializes a ship with the given coordinates and direction (bearing).
// If the ship is declared "virtual", then the ship gets initialized with
// its coordinates but DOESN'T get placed on the grid.
Ship.prototype.create = function(x, y, direction, virtual) {
	// This function assumes that you've already checked that the placement is legal
	this.xPosition = x;
	this.yPosition = y;
	this.direction = direction;

	// If the ship is virtual, don't add it to the grid.
	if (!virtual) {
		for (var i = 0; i < this.shipLength; i++) {
			if (this.direction === Ship.DIRECTION_VERTICAL) {
				this.playerGrid.cells[x + i][y] = CONST.TYPE_SHIP;
			} else {
				this.playerGrid.cells[x][y + i] = CONST.TYPE_SHIP;
			}
		}
	}
	
};
// direction === 0 when the ship is facing north/south
// direction === 1 when the ship is facing east/west
Ship.DIRECTION_VERTICAL = 0;
Ship.DIRECTION_HORIZONTAL = 1;


// Tutorial Object
// Constructor
function Tutorial() {
	this.currentStep = 0;
	// Check if 'showTutorial' is initialized, if it's uninitialized, set it to true.
	this.showTutorial = localStorage.getItem('showTutorial') !== 'false';
}
// Advances the tutorial to the next step
Tutorial.prototype.nextStep = function() {
	var humanGrid = document.querySelector('.human-player');
	var enemyGrid = document.querySelector('.enemy-player');
	switch (this.currentStep) {
		case 0:
			document.getElementById('roster-sidebar').setAttribute('class', 'highlight');
			document.getElementById('step1').setAttribute('class', 'current-step');
			this.currentStep++;
			break;
		case 1:
			document.getElementById('roster-sidebar').removeAttribute('class');
			document.getElementById('step1').removeAttribute('class');
			humanGrid.setAttribute('class', humanGrid.getAttribute('class') + ' highlight');
			document.getElementById('step2').setAttribute('class', 'current-step');
			this.currentStep++;
			break;
		case 2:
			document.getElementById('step2').removeAttribute('class');
			var humanClasses = humanGrid.getAttribute('class');
			humanClasses = humanClasses.replace(' highlight', '');
			humanGrid.setAttribute('class', humanClasses);
			this.currentStep++;
			break;
		case 3:
			enemyGrid.setAttribute('class', enemyGrid.getAttribute('class') + ' highlight');
			document.getElementById('step3').setAttribute('class', 'current-step');
			this.currentStep++;
			break;
		case 4:
			var enemyClasses = enemyGrid.getAttribute('class');
			document.getElementById('step3').removeAttribute('class');
			enemyClasses = enemyClasses.replace(' highlight', '');
			enemyGrid.setAttribute('class', enemyClasses);
			document.getElementById('step4').setAttribute('class', 'current-step');
			this.currentStep++;
			break;
		case 5:
			document.getElementById('step4').removeAttribute('class');
			this.currentStep = 6;
			this.showTutorial = false;
			localStorage.setItem('showTutorial', false);
			break;
		default:
			break;
	}
};


	// Start the game
	var mainGame = new Game(10);
})();

