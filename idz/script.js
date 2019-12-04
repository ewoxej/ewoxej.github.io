var userSymbol ='X';
var pcSymbol ='O';
var isPC=false;
function clickHandler(el)
{
	el.innerHTML=userSymbol;
	winChecker(Array.from(el.parentNode.children).indexOf(el));
	pcStep();
}

function formHandler()
{
	var isX = document.getElementById("symbolX").checked;
	if(isX == false)
	{
		userSymbol='O';
		pcSymbol='X';
	}
	isPC = document.getElementById("playerPC");
	var field = document.getElementById("game_field");
	field.style.display="block";
	var dlg = document.getElementById("initial_dialog");
	dlg.style.display="none";
}
function winChecker(index)
{
var combinations=[[0,1,2],[3,4,5],[6,7,8],[0,3,6],[1,4,7],[2,5,8],[0,4,8],[2,4,6]];
for(var i=0;i<combinations.length;i++)
{
	var currentSymbol = document.getElementsByTagName("td")[index].innerHTML;
	var isIndexInList = combinations[i].indexOf(index);
	if(isIndexInList != -1)
	{
		var arr = combinations[i];
		if(arr[0].innerHTML == currentSymbol && arr[1].innerHTML == currentSymbol && arr[2].innerHTML == currentSymbol)
		{
			alert(currentSymbol+" win");
		}
	}
}
}
function pcStep()
{
	var cells = document.getElementsByTagName("td");
	for (var i = 0; i < cells.length; i++) {
		if(cells[i].innerHTML!=userSymbol && cells[i].innerHTML!=pcSymbol)
		{
		cells[i].innerHTML=pcSymbol;
		break;
		}
}
}
