var userSymbol ='X';
var pcSymbol ='O';
var xWins=0;
var oWins=0;
var isWin=false;
var isPC=false;

function clickHandler(el)
{
	el.innerHTML=userSymbol;
	var cells = document.getElementsByTagName("td");
	winChecker(el.cellIndex +(el.parentNode.rowIndex*3));
	if(isWin==false)
	{
		pcStep();
	}
	else
	{
		isWin=false;
	}
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
var cells = document.getElementsByTagName("td");
for(var i=0;i<combinations.length;i++)
{
	var currentSymbol = document.getElementsByTagName("td")[index].innerHTML;
	var isIndexInList = combinations[i].indexOf(index);
	if(isIndexInList != -1)
	{
		var arr = combinations[i];
		if(cells[arr[0]].innerHTML == currentSymbol && cells[arr[1]].innerHTML == currentSymbol && cells[arr[2]].innerHTML == currentSymbol)
		{
			alert(currentSymbol+" has win");
			if(currentSymbol=='X') xWins++;
			if(currentSymbol=='O') oWins++;
			cleanField();
			var counter = document.getElementById("count");
			counter.innerHTML=String(xWins)+":"+String(oWins);
			isWin=true;
			break;
		}
	}
}
}

function cleanField()
{
	var cells = document.getElementsByTagName("td");
	for (var i = 0; i < cells.length; i++) {
		cells[i].innerHTML="&emsp;"
	}
}
function pcStep()
{
	var cells = document.getElementsByTagName("td");
	for (var i = 0; i < cells.length; i++) {
		if(cells[i].innerHTML!=userSymbol && cells[i].innerHTML!=pcSymbol)
		{
		cells[i].innerHTML=pcSymbol;
		winChecker(i);
		break;
		}
	
}
}
