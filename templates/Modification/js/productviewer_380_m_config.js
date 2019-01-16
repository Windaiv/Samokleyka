function thisMovie(movieName) {
	var isIE = navigator.appName.indexOf("Microsoft") != -1;
	return document[movieName];
}
	
var colorsObj = {
				19:"0xFFFFFF",
				20:"0xA4AEAD",
				21:"0x000000",
				26:"0xfdeb22",
				28:"0xc53f26",
				29:"0xe85d25",
				37:"0x59a1e8",
				41:"0x30722c"};

var colorsObj_2 = {
				102:"0xFFB901",
				103:"0xFF8601",
				104:"0xF6A6BF",
				106:"0x670001",
				108:"0x4B176C",
				110:"0x025285",
				111:"0x100553",
				114:"0x007C3E",
				118:"0x4D2501",
				119:"0xFFFFFF",
				121:"0x000000",
				125:"0xe6cc15",
				126:"0xfdeb22",
				128:"0xc53f26",
				129:"0xe85d25",
				132:"0xe6b1df",
				133:"0x3c4472",
				137:"0x59a1e8",
				147:"0x616161"};
				
var sideObj =  {57:1,
				58:-1};

/*				
function initiateColor(colorId) {
	if(colorsObj[colorId]) thisMovie("productviewer_380_2c").changeColor(colorsObj[colorId]);
	SelectColorSquare(".nuancier1", colorId);
}
*/

$(document).ready(function () {
	
	$(".change-color").change(function() {
		colorId = parseInt($(".change-color option:selected").val());
		SelectColorSquare(".nuancier1", colorId);
		if (hasReqestedVersion){
			if(colorsObj[colorId]) thisMovie("productviewer_380_2c").changeColor(colorsObj[colorId]);
		}
	});
	
	$(".change-color_2c").change(function() {
		colorId = parseInt($(".change-color_2c option:selected").val());
		SelectColorSquare(".nuancier2", colorId);
		if (hasReqestedVersion){
			if(colorsObj_2[colorId]) thisMovie("productviewer_380_2c").changeColor2(colorsObj_2[colorId]);
		}
	});
	
	$(".change-side").change(function() {
		sideId = parseInt($(".change-side option:selected").val());
		if (hasReqestedVersion){
			if(sideObj[sideId]){ thisMovie("productviewer_380_2c").changeSide(sideObj[sideId]);}
		}
	});
	
});

function SelectColorSquare(div, id){
	$("div > a").removeClass("selected");
	$("div > a#" + id).addClass("selected");
}

function initiateColorChange(colorName){
	var colorSelector = document.forms['cart_quantity'].elements['color'];
	SelectOptionInList(colorSelector, colorName);
	colorId = parseInt($(".change-color option:selected").val());
	SelectColorSquare(".nuancier1", colorId);
	if (hasReqestedVersion){
		if(colorsObj[colorId]) thisMovie("productviewer_380_2c").changeColor(colorsObj[colorId]);
	}
}

function initiateColorChange2(colorName){
	var colorSelector2 = document.forms['cart_quantity'].elements['color_2c'];
	SelectOptionInList(colorSelector2, colorName);
	colorId = parseInt($(".change-color_2c option:selected").val());
	SelectColorSquare(".nuancier2", colorId);
	if (hasReqestedVersion){
		if(colorsObj_2[colorId]) thisMovie("productviewer_380_2c").changeColor2(colorsObj_2[colorId]);
	}
}

function SelectOptionInList( lstSelectList, intID )
{
	try
	{
		  var intIndex = 0;
		  // Loop through all the options
		  for( intIndex = 0; intIndex < lstSelectList.options.length; intIndex++ )
		  {
			
			// Is this the ID we are looking for?
				if( lstSelectList.options[intIndex].value == intID )
				{
					  // Select it
					  lstSelectList.selectedIndex = intIndex;
					  // Yes, so stop searching
					  break;
				}
		  }
	}
	catch( expError )
	{
		  alert( "ClientUtilities1.js::SelectOptionInList( ).\n" +
				 "Error:" + expError.number + ", " + expError.description );
	}
}