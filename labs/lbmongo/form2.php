<?php
require 'vendor/autoload.php';
$client = new MongoDB\Client;
$collection = $client->dbforlab->items;

$res=$collection->find(array('total' => 0));
foreach($res as $i)
{
echo $i["title"]," :",$i["price"];
echo "<br><br>";
}
?>