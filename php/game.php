<?php require 'header.php';

if(!isset($_SESSION['id'])){
    header('Location: redirect.php');
    exit;
}

?>
<main class="background-img">
	<div class="container"> 
		
		<ol class="instructions">
			<p>How to play</p>
			<li id="step1">Select your ships from the left-hand side</li>
			<li id="step2">Place your ships on your map</li>
			<li id="step3">Click on the cells of the enemy's map<br>
			to find and destroy all five enemy ships</li>
			<li id="step4">You need to wait on the enemy to shoot at his cell before shooting again</li>
		</ol>
	<div class="game-container">
			<div id="restart-sidebar" class="hidden">
				<h2>Try Again</h2>
				<button id="restart-game">Restart Game</button>
			</div>
			
			<div id="roster-sidebar">
				<h2>Place Your Ships</h2>
				<ul class="fleet-roster">
					<li id="patrolboat">Patrol Boat</li>
					<li id="submarine">Submarine</li>
					<li id="destroyer">Destroyer</li>
					<li id="battleship">Battleship</li>
					<li id="carrier">Aircraft Carrier</li>
				</ul>
				<button id="rotate-button" data-direction="0">Rotate Ship</button>
				<button id="start-game" class="hidden">Start Game</button>
				<button id="place-randomly" class="hidden">Place Randomly and Start</button>
			</div>
			
			<div id="stats-sidebar">
				<h2>Stats</h2>
				<p><strong>Games Won</strong></p>
				<p id="stats-wins">0 of 0</p>
				<p><strong>Accuracy</strong></p>
				<p id="stats-accuracy">0%</p>
				<button id="reset-stats">Reset Stats</button>
				<button id="prob-heatmap" class="hidden">Show Probability Heatmap</button>
			</div>
			
			<div class="grid-container">
				<h2>Your Fleet</h2>
				<div class="grid human-player"><span class="no-js">Please enable JavaScript to play this game</span></div>
			</div>
			
			<div class="grid-container">
				<h2>Enemy Fleet</h2>
				<div class="grid enemy-player"><span class="no-js">Please enable JavaScript to play this game</span></div>
			</div>

		</div>
	</div>
</main>

	

<script src="../app.js" >

</script>

<?php require 'footer.php'?>