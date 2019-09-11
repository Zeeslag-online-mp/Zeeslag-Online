<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '';
$dbName = 'p5_sql_1';

$db = new PDO(
    "mysql:host=$dbHost;dbname=$dbName",
    $dbUser,
    $dbPass
);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

$sql = "select * from studenten";

$prepare = $db->prepare($sql);
$prepare->execute([]);
$student = $prepare->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$time = json_encode($student);

echo "data:{$time}\n\n";
flush();
?>