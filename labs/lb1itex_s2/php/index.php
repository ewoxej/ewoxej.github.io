<?php
require "connect_to_db.php";

$dbh=MySQLDatabase::connect("lb1itex","root","");
$sth_1 = $dbh->prepare("SELECT name ID_Vendors FROM vendors");
$sth_1->execute();
  
$result_1 = $sth_1->fetchAll(PDO::FETCH_ASSOC);

$sth_2 = $dbh->prepare("SELECT name ID_Category FROM category");
$sth_2->execute();

$result_2 = $sth_2->fetchAll(PDO::FETCH_ASSOC);

?>


<p><h2>Task 1</h2></p>
<p><b>товары выбранного производителя</b></p>
<form action="form1.php" method="get">
<select name="vendorname">
	<?php
    foreach($result_1 as $val){
      foreach($val as $temp){
        echo "<option>$temp</option>";
      }
      print("\n");
    }
  ?>
	</select>
<p><input type="submit" value="submit"></p>
</form>


<p><h2>Task 2</h2></p>
<p><b>товары выбранной категории<b></p>
<form action="form2.php" method="get">
	<select name="category_name">
	<?php
    foreach($result_2 as $val){
      foreach($val as $temp){
        echo "<option>$temp</option>";
      }
      print("\n");
    }
  ?>
	</select>
  <p><input type="submit" value="submit"/></p>
</form>


<p><h2>Task 3</h2></p>
<p><b>товары в выбранном ценовом диапазоне</b></p>
<form action="form3.php" method="get">
<p>Min:<input id="lower_bound" type="number" name="lower_bound" required></p>
<p>Max:<input id="lower_bound" type="number" name="upper_bound" oninput="validate()" required></p>
<p><input type="submit" value="submit"></p>
</form>