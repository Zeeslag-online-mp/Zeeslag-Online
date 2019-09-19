<?php require 'header.php';
if(!isset($_SESSION['id'])){
    header('Location: redirect.php');
    exit;
}


?>

<main class="background-img">
<div class="container">
	<div id="game-container" class="game-container">
		
		<div id="grid">
        <div id="boat"></div>
			<div  id="grid-myplayer">
					
			</div>
		</div>
		
				
		<div  id="grid-enemyplayer">		

		</div>
	</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/interactjs/dist/interact.min.js"></script>
<script src="../js/game.js"></script>
</main>
<?php require 'footer.php'; ?>
