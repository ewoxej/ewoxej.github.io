<?php
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
echo '<?xml version="1.0" encoding="utf8" ?>';
echo "<root>";

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
foreach ($stmt->fetchAll() as $row)
{
echo "<row><Name>$row[name]</Name><Price>$row[price]</Price>
<Quantity>$row[quantity]</Quantity></row>";
}
echo "</root>";

?>