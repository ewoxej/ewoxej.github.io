<?php
echo "<table style='border: solid 1px black;'>";
echo "<tr><th>vendor</th><th>item</th><th>price</th><th>quantity</th></tr>";

require "connect_to_db.php";
require "table_rows.php";

$dbh=MySQLDatabase::connect("lb1itex","root","");

$vendor_name=$_GET["vendorname"];

$stmt = $dbh->prepare("SELECT vendors.name,items.name,items.price,items.quantity FROM
 `items` JOIN Vendors ON FID_Vendor=Vendors.ID_Vendors WHERE vendors.Name=(:vendorname)");
$stmt->bindParam(':vendorname', $vendor_name);
$stmt->execute();

$result = $stmt->setFetchMode(PDO::FETCH_NUM);
foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll()))as $k=>$v){
  echo $v;
}

?>