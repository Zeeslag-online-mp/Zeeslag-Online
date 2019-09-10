<?php

require 'config.php';

$userId = $_SESSION['id'];

if (isset($_GET['friend-id'])) {

	$friendId = $_GET['friend-id']; 

	$sql = "INSERT INTO `game_request` (`send_from`, `send_to`) VALUES (:userId, :friendId);";
	$prepare = $db->prepare($sql);
	$prepare->execute([
		':userId' => $userId,
		':friendId' => $friendId
	]);
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