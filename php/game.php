<?php require 'header.php'?>

<?php 

if (!isset($_SESSION['id'])) {
	header('Location: login.php');
}

?>

<main class="background-img">
<div class="container">
	<div id="game-container" class="game-container">
		<div id="boat"></div>
                <div id="battleship"></div>
                
		<div id="grid">
			<div  id="grid-myplayer">
					
			</div>
		</div>
		
				
		<div  id="grid-enemyplayer">		

		</div>
	</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
<script src="../js/game.js"></script>

<?php require 'footer.php'; ?>
