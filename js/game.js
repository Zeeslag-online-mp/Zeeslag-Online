
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
    //schepen
    var availableShips = ['Patrol Boat', 'Destroyer', 'Cruiser', 'Battleship', 'Carrier' ];
    var css_Type_Empty = 'empty';
    var css_Type_Ship = 'ship';
    var css_Type_Miss = 'miss';
    var css_Type_Hit = 'hit';
    var css_Type_Sunk = 'sunk';
    //grid code
    var type_Empty = 0;
    var type_Ship = 1;
    var type_Miss = 2;
    var type_Hit = 3;
    var type_Sunk= 4;
    
    function Game(size){
        Game.size = size
        this.createGrid();
        this.init();
       
    }
    Game.size = 10;

    let board = new Array(100).fill(null);
    console.log(board);
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
    
   Game.prototype.rosterListener = function(e) {
        var self = e.target.self;
        var roster = document.querySelectorAll('.fleet-roster li');
        for(var i = 0; i < roster.length; i++) {
            var classes = roster[i].getAttribute('class') || '';
            roster[i].setAttribute('class', classes);
        }

        Game.placeShipType = e.target.getAttribute('id');
        document.getElementById(Game.placeShipType).setAttribute('class', 'placing');
        self.placingOnGrid = true;
    }

    Game.prototype.placementListener = function(e){
        var self = e.target.self;
        if(self.placingOnGrid) {
            var gridData = parseInt(e.target.getAttribute('grid-cell'), 10);
            var succesful = self.humanfleet.placeShip(gridData, Game.placeShipType);
            
        }
    }
    
    Game.prototype.areAllShipsPlaced = function() {
        var playerRoster = document.querySelectorAll('.fleet-roster li');
        for (var i = 0; i < playerRoster.length; i++) {
            if (playerRoster[i].getAttribute('class') === 'placed') {
                continue;
            } else {
                return false;
            }
        }
        // Reset temporary variables
        Game.placeShipDirection = 0;
        Game.placeShipType = '';
        Game.placeShipCoords = [];
        return true;
    };

    function Grid(size){
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
    Grid.prototype.updateCell = function(x, y, type) {
        switch(type){
            case css_Type_Empty:
                this.cells[x][y] = type_Empty;
                break;
            case css_Type_Ship:
                thsi.cells[x][y] = type_Ship;
                break;
            case css_Type_Miss:
                this.cells[x][y] = type_Miss;
                break;
            case css_Type_Hit:
                this.cells[x][y] = type_Hit;
                break;
            case css_Type_Sunk:
                this.cells[x][y] = type_Sunk;
                break;
            default:
                this.cells[x][y] = type_Empty;
                break;

        }
        var classes = [ 'grid-cell', 'grid-cell-' + x + '-' + y, 'grid-' + type];
        document.querySelector('.' + player + ' .grid-cell-' + x + '-' + y).setAttribute('class', classes.join(' '));
        
    }

    Grid.prototype.isUndamagedShip = function(x, y) {
        return this.cells[x][y] === type_Ship;
    };

    Grid.prototype.isMiss = function(x, y) {
        return this.cells[x][y] === type_Miss;
    };

    Grid.prototype.isDamagedShip = function(x, y) {
        return this.cells[x][y] === type_Miss;
    };


 function Ship(type, playerGrid, player){
    this.damage = 0;
	this.type = type;
	this.playerGrid = playerGrid;
    this.player = player;
    switch(this.type){
        case availableShips[0]:
			this.shipLength = 2;
			break;
		case availableShips[1]:
			this.shipLength = 3;
			break;
		case availableShips[2]:
			this.shipLength = 3;
			break;
		case availableShips[3]:
			this.shipLength = 4;
			break;
		case availableShips[4]:
			this.shipLength = 5;
			break;
		default:
			this.shipLength = 3;
            break;

    }
    this.maxDamage = this.shipLength;
    this.sunk = false;
    Ship.prototype.isLegal = function(x, y, direction) {
        if(this.withinBounds(x, y, direction)) {
            for (var i = 0; i < this.shipLength; i++){
                if(direction === Ship.DirectionVertical) {
                    if(this.playerGrid.cells[x + i][y] === type_Ship ||
                        this.playerGrid.cells[x + i][y] === type_Miss ||
                        this.playerGrid.cells[x + i][y] === type_Sunk){
                            return false;
                        }
                }else{
                    if(this.playerGrid.cells[x][y + i] === type_Ship ||
                        this.playerGrid.cells[x][y + i] === type_Miss ||
                        this.playerGrid.cells[x][y + i] === type_Sunk)
                        return false;
                }
            }
        }else{
            return false;
        }
    };

    Ship.prototype.withinBounds = function(x, y, direction) {
        if(direction === Ship.DirectionVertical) {
            return x + this.shipLength <= Game.size;
        } else {
            return y + this.shipLength <= Game.size;
        }
    };

    Ship.prototype.incrementDamage = function() {
        this.damage++
        if (this.isSunk()) {
            this.sinkShip(false);
        }
    };

    Ship.prototype.sinkShip = function(virtual) {
        this.damage = this.maxDamage;
        this.sunk = true;

        if(!virtual) {
            var allCells = this.getAllShipCells();
            for (var i = 0; i < this.shipLength; i++){
                this.playerGrid.updateCell(allCells[i].x, allcells[i].y, 'sunk', this.player);
            }
        }
    };


    Ship.prototype.getAllShipCells = function(){
        var resultObject = [];
        for( var i = 0; i < this.shipLength; i++) {
            if (this.direction === Ship.DirectionVertical) {
                resultObject[i] = {'x': this.xPosition + i, 'y': this.yPosition + i};

            }else{
                resultObject[i] = {'x': this.xPosition, 'y': this.yPosition + i};
            }
        }
        return resultObject;
    };

    Ship.prototype.create = function(x, y, direction, virtual) {
        this.xPosition = x;
        this.yPosition = y;
        this.direction = direction;

        if(!virtual) {
            for( var i = 0; i < this.shipLength; i++) {
                if(this.direction === Ship.DirectionVertical) {
                    this.gameBoardPlayer.cells[x + i][y] = type_Ship;
                }else{
                    this.gameBoardPlayer.cells[x][y + i] = type_Ship;
                }
            }
        }
    };
    Ship.DirectionVertical = 0;
    Ship.Directionhorizontal = 1;


 }
    function Fleet(playerGrid, player){
        this.numShips = availableShips.length;
        this.playerGrid = playerGrid;
        this.player = player;
        this.fleetRoster = [];
        this.populate();

    }

    Fleet.prototype.populate = function() {
        for(var i = 0; i < this.numShips; i++ ){
            var j = i % availableShips.length;
            this.fleetRoster.push(new Ship(availableShips[j], this.playerGrid, this.player));
        }
    }

    Fleet.prototype.placeShip = function(x, y, direction, shipType) {
        var shipCoords;
        for (var i = 0; i < this.fleetRoster.length; i++) {
            var shipTypes = this.fleetRoster[i].type;
            if(shipType === shipTypes &&
                this.fleetRoster[i].isLegal(x, y, direction)) {
                    this.fleetRoster[i].create(x, y, direction, false);
                    shipCoords = this.fleetRoster[i].getAllShipCells();

                    for (var j = 0; j < shipCoords.length; j++) {
                        this.playerGrid.updateCell(shipCoords[j].x, shipCoords[j].y, 'ship', this.player);
                    }
                }
        }
        return false;
    };

    Game.prototype.init = function() {
        this.humanGrid = new Grid(Game.size);
        this.enemyGrid = new Grid(Game.size);
        this.humanFleet = new Fleet(Game.size);

        var playerRoster = document.querySelector('.fleet-roster').querySelectorAll('li');
        for (var i = 0; i < playerRoster.length; i++) {
            playerRoster[i].self = this;
            playerRoster[i].addEventListener('click', this.rosterListener, false);
        }

       
    }

    
    var mainGame = new Game();
})();
