<?php
require 'vendor/autoload.php';
$client = new MongoDB\Client;
$collection = $client->dbforlab->items;

$lower=$_GET["lower_bound"];
$upper=$_GET["upper_bound"];
$res=$collection->find(array('price' => array('$gt' =>  floatval($lower), '$lt' => floatval($upper))));
foreach($res as $i)
{
echo $i["title"]," :",$i["price"];
echo "<br><br>";
}
?>