<?php
require 'vendor/autoload.php';
$client = new MongoDB\Client;
$collection = $client->dbforlab->items;

$res=$collection->distinct("producer");
foreach($res as $i)
{
	print($i);
	echo "<br>";
}
?>