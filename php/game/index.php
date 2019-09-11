

<!doctype html>
<html lang="en">
<head>
	
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<link rel="image_src" href="img/apple-touch-icon-144x144-precomposed.png" />
	<link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/apple-touch-icon-57x57-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png" />


	<link href="css/styles.css"  rel="stylesheet" media="all"/>
</head>
<body>
<div class="container1">
	<div class="game-container">
		<div id="restart-sidebar" class="hidden">
			<h2>Try Again</h2>
			<button id="restart-game">Restart Game</button>
		</div><div id="roster-sidebar">
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
		</div><div id="stats-sidebar">
			<h2>Stats</h2>
			<p><strong>Games Won</strong></p>
			<p id="stats-wins">0 of 0</p>
			<p><strong>Accuracy</strong></p>
			<p id="stats-accuracy">0%</p>
			<button id="reset-stats">Reset Stats</button>
			<button id="prob-heatmap" class="hidden">Show Probability Heatmap</button>
		</div><div class="grid-container">
			<h2>Your Fleet</h2>
			<div class="grid human-player"><span class="no-js">Please enable JavaScript to play this game</span></div>
		</div><div class="grid-container">
			<h2>Enemy Fleet</h2>
			<div class="grid computer-player"><span class="no-js">Please enable JavaScript to play this game</span></div>
		</div>
	</div>
</div>

<script>
// Don't change this variable.
var DEBUG_MODE = localStorage.getItem('DEBUG_MODE') === 'true';
// To turn DEBUG_MODE on, run `setDebug(true);` in the console.
if (!DEBUG_MODE) {
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-10730961-10', 'auto');
	ga('send', 'pageview');
}
</script>

<script src="js/battleboat.js"></script>
<span class="prefetch" id="prefetch1"></span>
<span class="prefetch" id="prefetch2"></span>
<span class="prefetch" id="prefetch3"></span>
</body>
</html>
