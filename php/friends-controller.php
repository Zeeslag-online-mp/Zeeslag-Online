<?php

require 'config.php';

$userId = $_SESSION['id'];

if (isset($_GET['send-invite'])) {

	$friendId = $_GET['friend-id']; 

	$sql = "INSERT INTO `game_request` (`send_from`, `send_to`, `valid`, `seen`) VALUES (:userId, :friendId, 0, 0);";
	$prepare = $db->prepare($sql);
	$prepare->execute([
		':userId' => $userId,
		':friendId' => $friendId
	]);

	$displayMessage = "Speler uitgenodigd, wacht totdat hij de uitnodiging accepteerd.";
}
else if (isset($_GET['fetch-invites'])) {

	$sql = "SELECT * FROM `game_request` WHERE `send_to` = :userId;";
	$prepare = $db->prepare($sql);
	$prepare->execute([
		':userId' => $userId
	]);

	$gameRequests = $prepare->fetchAll(PDO::FETCH_ASSOC);

	$users;

	$i = 0;
	foreach ($gameRequests as $request) {

		$id = $request['send_from'];

		$sql = "SELECT * FROM `users` WHERE `id` = :send_from;";
		$prepare = $db->prepare($sql);
		$prepare->execute([
			':send_from' => $id
		]);

		$user = $prepare->fetch(PDO::FETCH_ASSOC);

		if ($i === 0) {
			$users[0] = $user;
		}
		else {
			array_push($users, $user);
		}
		
		$i++;

	}

	echo json_encode($users); // Echo it to the page so you can use it in JavaScript function

}
else if (isset($_GET['remove-invite'])) {

	$id = $_SESSION['id'];

	$sql = "DELETE FROM `game_request` WHERE `send_to` = :id;";
	$prepare = $db->prepare($sql);
	$prepare->execute([
		':id' => $_SESSION['id']
	]);
}
// Linking a friend/user to another user in the database
else if (isset($_GET['add-friend'])) {

	$friend = htmlspecialchars($_POST['friend']); // Username of the friend you want to add

	// Fetching id and username from the specified friend
	$sql = "SELECT `id`, `username` FROM `users` WHERE `username` = :friend;";
	$prepare = $db->prepare($sql);
	$prepare->execute([
		':friend' => $friend
	]);

	$friendInfo = $prepare->fetch(PDO::FETCH_ASSOC); // Fetching returned data

	// Fetching friends table
	$sql = "SELECT * FROM `friends`;";
	$prepare = $db->prepare($sql);
	$prepare->execute();

	$friendList = $prepare->fetchAll(PDO::FETCH_ASSOC);

	// When friend name doesn't exists
	if (empty($friendInfo)) {

		$_SESSION['message'] = "Sorry, we konden speler met de naam ".$friend." niet vinden.";
		header('Location: http://'.$host.'/Zeeslag-Online/php/friend-list.php');
		exit;
	}
	// When the friend you want to add is yourself
	else if ($friendInfo['id'] === $userId) {

		$_SESSION['message'] = "Sorry, maar je kan je zelf niet als vriend toevoegen.";
		header('Location: http://'.$host.'/Zeeslag-Online/php/friend-list.php');
		exit;
	}

	// Linking user 1 to user 2 (friend)
	$sql = "INSERT INTO `friends` VALUES(:userId, :friendId);";
	$prepare = $db->prepare($sql);
	$prepare->execute([
		':userId' 	=> $userId,
		':friendId' => $friendInfo['id']
	]);

	// Message when friend is succesful added
	$_SESSION['message'] = $friendInfo['username']." is nu jouw vriend.";

	// Redirect user back to friendlist
	header('Location: http://'.$host.'/Zeeslag-Online/php/friend-list.php');
	exit;
}