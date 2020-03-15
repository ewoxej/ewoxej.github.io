<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>item</th><th>price</th><th>quantity</th></tr>";

require "connect_to_db.php";
require "table_rows.php";

$dbh=MySQLDatabase::connect("lb1itex","root","");

$lower_bound=$_GET["lower_bound"];
$upper_bound=$_GET["upper_bound"];

$stmt = $dbh->prepare("SELECT items.name,items.price,items.quantity FROM
 `items` WHERE items.price > (:lower_bound) and items.price < (:upper_bound)");
$stmt->bindParam(':lower_bound', $lower_bound);
$stmt->bindParam(':upper_bound', $upper_bound);
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll()))as $k=>$v){
  echo $v;
}

?>