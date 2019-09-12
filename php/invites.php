<?php

require 'config.php';

$sql = "SELECT `g`.`id`, `sf`.`username`, `g`.`timestamp` AS `send_from`, `st`.`username` AS `send_to` FROM `game_request` AS `g` 
	INNER JOIN `users` AS `sf` ON `g`.`send_from` = `sf`.`id`
	INNER JOIN `users` AS `st` ON `g`.`send_to` = `st`.`id`
	WHERE `st`.`id` = :id;";
$prepare = $db->prepare($sql);
$prepare->execute([
	':id' => $_SESSION['id']
]);

$invites = $prepare->fetchAll(PDO::FETCH_ASSOC);

echo '<ul>';
foreach ($invites as $invite) {

	echo '<li>';
	echo $invite['send_from'].' heeft je uitgenodigt om '.$invite['timestamp'].'.';
	echo '</li>';
}
echo '</ul>';