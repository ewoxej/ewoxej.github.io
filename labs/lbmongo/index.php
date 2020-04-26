<script>
function appendValuesToList()
{
	var minPrevValues = JSON.parse(localStorage.getItem("minPrevValues"));
	var minList = document.getElementById("dlist_min");
	for (var item in minPrevValues)
	{
		var p = document.createElement("option");
		p.value=minPrevValues[item];
		p.text=minPrevValues[item].toString();
		minList.appendChild(p);
	}
	var maxPrevValues = JSON.parse(localStorage.getItem("maxPrevValues"));
	var maxList = document.getElementById("dlist_max");
	for (var item in maxPrevValues)
	{
		var p = document.createElement("option");
		p.value=maxPrevValues[item];
		p.text=maxPrevValues[item].toString();
		maxList.appendChild(p);
	}
}

function saveValuesToStorage()
{
	if(localStorage.getItem("minPrevValues") == null)
	{
		localStorage.setItem("minPrevValues",JSON.stringify([document.getElementById("lower_bound").value]));
	}
	else
	{
	var minPrevValues = JSON.parse(localStorage.getItem("minPrevValues"));
	minPrevValues.push(document.getElementById("lower_bound").value);
	localStorage.setItem("minPrevValues",JSON.stringify(minPrevValues));
	}
	if(localStorage.getItem("maxPrevValues") == null)
	{
		localStorage.setItem("maxPrevValues",JSON.stringify([document.getElementById("upper_bound").value]));
	}
	else
	{
	var maxPrevValues = JSON.parse(localStorage.getItem("maxPrevValues"));
	maxPrevValues.push(document.getElementById("upper_bound").value);
	localStorage.setItem("maxPrevValues",JSON.stringify(maxPrevValues));
	}
return true;
}

</script>
<body onload="appendValuesToList();">
<p><h2>Task 1</h2></p>
<p><b>Список производителеей</b></p>
<form action="form1.php" method="get">
<p><input type="submit" value="submit"></p>
</form>


<p><h2>Task 2</h2></p>
<p><b>Товары которых нет на складе<b></p>
<form action="form2.php" method="get">
  <p><input type="submit" value="submit"/></p>
</form>


<p><h2>Task 3</h2></p>
<p><b>товары в выбранном ценовом диапазоне</b></p>
<form action="form3.php" method="get" onsubmit="saveValuesToStorage();">
<p>
	Min:
    <input list="dlist_min" id="lower_bound" type="number" name="lower_bound" required>
    <datalist id="dlist_min">
    </datalist>
</p>
<p>
	Max:
    <input list="dlist_max" id="upper_bound" type="number" name="upper_bound" required>
    <datalist id="dlist_max">
    </datalist>
</p>

<p><input type="submit" value="submit"></p>
</form>
</body>