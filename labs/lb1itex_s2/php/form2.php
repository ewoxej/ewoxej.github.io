<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>category</th><th>item</th><th>price</th><th>quantity</th></tr>";

require "connect_to_db.php";
require "table_rows.php";

$dbh=MySQLDatabase::connect("lb1itex","root","");

$category_name=$_GET["category_name"];

$stmt = $dbh->prepare("SELECT category.name,items.name,items.price,items.quantity FROM
 `items` JOIN Category ON FID_Category=Category.ID_Category WHERE category.Name=(:category_name)");
$stmt->bindParam(':category_name', $category_name);
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll()))as $k=>$v){
  echo $v;
}

?>