<?php
require "connect_to_db.php";

$dbh=MySQLDatabase::connect("lb1itex","root","");
$sth_1 = $dbh->query("SELECT name ID_Vendors FROM vendors");

$sth_2 = $dbh->query("SELECT name ID_Category FROM category");

?>


<p><h2>Task 1</h2></p>
<p><b>Товары выбранного производителя</b></p>
<form action="form1.php" method="get">
<select name="vendorname">
	<?php
      foreach($sth_1 as $val){
        echo "<option>$val[0]</option>";
      }
      print("\n");
  ?>
</select>
<p><input type="submit" value="submit"></p>
</form>


<p><h2>Task 2</h2></p>
<p><b>Товары выбранной категории<b></p>
<form action="form2.php" method="get">
	<select name="category_name">
	<?php
    foreach($sth_2 as $val){
        echo "<option>$val[0]</option>";
      }
      print("\n");
  ?>
	</select>
  <p><input type="submit" value="submit"/></p>
</form>


<p><h2>Task 3</h2></p>
<p><b>товары в выбранном ценовом диапазоне</b></p>
<form action="form3.php" method="get">
<p>Min:<input id="lower_bound" type="number" name="lower_bound" required></p>
<p>Max:<input id="upper_bound" type="number" name="upper_bound" required></p>
<p><input type="submit" value="submit"></p>
</form>