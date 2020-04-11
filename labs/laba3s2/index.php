<?php
require "connect_to_db.php";

$dbh=MySQLDatabase::connect("lb1itex","root","");
$sth_1 = $dbh->query("SELECT name ID_Vendors FROM vendors");

$sth_2 = $dbh->query("SELECT name ID_Category FROM category");

?>

<script>
var ajax; // глобальная переменная для хранения обработчика запросов
InitAjax();
function InitAjax() 
{
	try 
	{ /* пробуем создать компонент XMLHTTP для IE старых версий */
	ajax = new ActiveXObject("Microsoft.XMLHTTP");
	} 
		catch (e) 
		{
		try 
			{//XMLHTTP для IE версий >6
			ajax = new ActiveXObject("Msxml2.XMLHTTP");
			} 
			catch (e) 
			{
			    try 
				{// XMLHTTP для Mozilla и остальных
				ajax = new XMLHttpRequest();
				} 
				catch(e) 
				{ ajax = 0; }
			}
		}
}

function sendAjaxGetRequest(request_string,response_handler)
{
	if (!ajax) 
	{
		alert("Ajax не инициализирован");
		return;
	}
	ajax.onreadystatechange = response_handler;
	ajax.open( "GET", request_string, true );
	ajax.send(null);
}

function task1() 
{
	var val = document.getElementById("vendorname").value;
	var params = 'vendorname=' + encodeURIComponent(val);
	sendAjaxGetRequest("form1.php?"+params, onTask1Response );
}

function task2() 
{
	var val = document.getElementById("category_name").value;
	var params = 'category_name=' + encodeURIComponent(val);
	sendAjaxGetRequest("form2.php?"+params, onTask2Response );
}

function task3() 
{
	var minval = document.getElementById("lower_bound").value;
	var maxval = document.getElementById("upper_bound").value;
	var params = 'lower_bound=' + encodeURIComponent(minval)+'&upper_bound='+encodeURIComponent(maxval);
	sendAjaxGetRequest("form3.php?"+params, onTask3Response );
}

function onTask1Response()
{
	if (ajax.readyState == 4) 
	{
		if (ajax.status == 200) 
		{
			var d1 = document.getElementById('vendorname'); 
			d1.insertAdjacentHTML('afterend', ajax.responseText);
		}
		else alert(ajax.status + " - " + ajax.statusText);
		ajax.abort();
	}
}

function onTask2Response()
{
	if (ajax.readyState == 4) 
	{
		if (ajax.status == 200) 
		{
			var d1 = document.getElementById('category_name'); 
			var obj = JSON.parse(ajax.responseText);
			d1.insertAdjacentHTML('afterend', "<table id='category_table'style='border: solid 1px black;'><tr><th>item</th><th>price</th><th>quantity</th></tr></table>");
			var table = document.getElementById('category_table'); 
			for(var i in obj)
			{
				  var tr = document.createElement("tr");
				  tr.innerHTML = '<td>'+obj[i]["name"]+'</td> <td>'+obj[i]["price"]+'</td> <td>'+obj[i]["quantity"]+'</td>';
				  table.appendChild(tr);
			}

		}
		else alert(ajax.status + " - " + ajax.statusText);
		ajax.abort();
	}
}

function onTask3Response()
{
	if (ajax.readyState == 4) 
	{
		if (ajax.status == 200) 
		{
			var d1 = document.getElementById('upper_bound'); 
			d1.insertAdjacentHTML('afterend', "<table id='category_table'style='border: solid 1px black;'><tr><th>item</th><th>price</th><th>quantity</th></tr></table>");
			var table = document.getElementById('category_table'); 
			var xml = ajax.responseXML;
			for (var i = 0; i < xml.getElementsByTagName("row").length; i++) {
			var result = document.createElement("tr");
			result.innerHTML += "<td>" + xml.getElementsByTagName("Name")[i].childNodes[0].nodeValue + "</td>";
			result.innerHTML  += "<td>" + xml.getElementsByTagName("Price")[i].childNodes[0].nodeValue + "</td>";
			result.innerHTML  += "<td>" + xml.getElementsByTagName("Quantity")[i].childNodes[0].nodeValue+ "</td>";
			table.appendChild(result);
			}
		}
		else alert(ajax.status + " - " + ajax.statusText);
		ajax.abort();
	}
}

</script>
<p><h2>Task 1</h2></p>
<p><b>Товары выбранного производителя</b></p>
<form method="get">
<select name="vendorname" id="vendorname">
	<?php
      foreach($sth_1 as $val){
        echo "<option>$val[0]</option>";
      }
      print("\n");
  ?>
</select>
<p><input type="button" value="submit" onclick="task1();"></p>
</form>


<p><h2>Task 2</h2></p>
<p><b>Товары выбранной категории<b></p>
<form method="get">
	<select name="category_name" id ="category_name">
	<?php
    foreach($sth_2 as $val){
        echo "<option>$val[0]</option>";
      }
      print("\n");
  ?>
	</select>
  <p><input type="button" value="submit" onclick="task2();"/></p>
</form>


<p><h2>Task 3</h2></p>
<p><b>товары в выбранном ценовом диапазоне</b></p>
<form method="get">
<p>Min:<input id="lower_bound" type="number" name="lower_bound" required></p>
<p>Max:<input id="upper_bound" type="number" name="upper_bound" required></p>
<p><input type="button" value="submit" onclick="task3();"></p>
</form>