<?php

require 'config.php'; // Include config.php file

session_start(); // Starts session so you can use $_SESSION variable

$id = $_SESSION['id']; // ID of user that is logged in

echo "Hallo ".$_SESSION['username'];

// Fetch friends from users out of database
$sql = "SELECT * FROM `friends` WHERE `user_1` = :id OR `user_2` = :id;";
$prepare = $db->prepare($sql);
$prepare->execute([
	':id' => $id
]);

$friends = $prepare->fetchAll(PDO::FETCH_ASSOC);

echo '<p>Zie hier uw vrienden</p>';

echo '<ul>';
foreach ($friends as $friend) {

	if ($friend['user_1'] != $id) {

		$sql = "SELECT * FROM `users` WHERE `id` = :id;";
		$prepare = $db->prepare($sql);
		$prepare->execute([
			':id' => $friend['user_1']
		]);

		$friendInfo = $prepare->fetch(PDO::FETCH_ASSOC);

		echo '<li><a href="" onclick="">';
		echo $friendInfo['username'];
		echo '</a></li>';
	}
	else {

		$sql = "SELECT * FROM `users` WHERE `id` = :id;";
		$prepare = $db->prepare($sql);
		$prepare->execute([
			':id' => $friend['user_2']
		]);

		$friendInfo = $prepare->fetch(PDO::FETCH_ASSOC);

		echo '<li>';
		echo $friendInfo['username'];
		echo '<button type="button" id="'.$friendInfo['id'].'" onclick="sendRequest(this.id)">Uitnodigen</button>';
		echo '</li>';
	}
	
}
echo '</ul>';


?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>

// When a user sends a friend request
function sendRequest(id) {

	$.ajax({
        url:"friends-controller.php?friend-id=" + id, // Goes to script which sends request to database
        type: "POST", // Request type
        success:function(result){ // When request to script is succesful
         alert(result);
       }
     });
}

// Sends to friends controller which checks the database for friend requests
function getRequest() {

	$.ajax({
        url:"friends-controller.php?request=hallo", // Goes to script which sends request to database
        type: "POST", // Request type
        success:function(result){ // When request to script is succesful

        	var friendRequests = result;
         
        	for (i = 0; i < friendRequests.length; i++) {

        		var request = friendRequests.i;

        		alert(request.username);

        	}

       }
     });
}

getRequest(); // Runs function on page load

// Runs function every 5 seconds to check for friend requests
setInterval( function() {
	getRequest()
}, 5000);

</script>