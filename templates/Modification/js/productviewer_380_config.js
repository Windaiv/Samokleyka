function thisMovie(movieName) {
	var isIE = navigator.appName.indexOf("Microsoft") != -1;
	return document[movieName];
}
	
var colorsObj = {1:"0xFAF708",
				2:"0xFFB901",
				3:"0xFF8601",
				4:"0xF6A6BF",
				5:"0xD62901",
				6:"0x670001",
				7:"0x7C7DBD",
				8:"0x4B176C",
				9:"0x4998B7",
				10:"0x025285",
				11:"0x100553",
				12:"0x04947B",
				13:"0x6B9D00",
				14:"0x007C3E",
				15:"0x015836",
				16:"0xB58937",
				17:"0xCE7318",
				18:"0x4D2501",
				19:"0xFFFFFF",
				20:"0xA4AEAD",
				21:"0x000000",
				24:"0xCD0567",
				25:"0xe6cc15",
				26:"0xfdeb22",
				27:"0x9d361c",
				28:"0xc53f26",
				29:"0xe85d25",
				30:"0xed6e20",
				31:"0x57486d",
				32:"0xe6b1df",
				33:"0x3c4472",
				34:"0x384ce2",
				35:"0x4c74c1",
				36:"0x25a2cb",
				37:"0x59a1e8",
				38:"0xa6cbf7",
				39:"0x11a299",
				40:"0x92e6c4",
				41:"0x30722c",
				42:"0x45a13c",
				43:"0x6cad1f",
				44:"0x96cb49",
				45:"0xddd89e",
				46:"0xf2e7a6",
				47:"0x616161",
				48:"0xdadada",
				50:"0xA8B1B8",
				51:"0xB38808"};
	
var sideObj =  {57:1,
				58:-1};

/*				
function initiateColor(colorId) {
	if(colorsObj[colorId]) thisMovie("productviewer_380").changeColor(colorsObj[colorId]);
	SelectColorSquare(".nuancier1", colorId);
}
*/

$(document).ready(function () {
	
	$(".change-color").change(function() {
		colorId = parseInt($(".change-color option:selected").val());
		SelectColorSquare(".nuancier1", colorId);
		if (hasReqestedVersion){
			if(colorsObj[colorId]) thisMovie("productviewer_380").changeColor(colorsObj[colorId]);
		}
	});
	
	$(".change-side").change(function() {
		sideId = parseInt($(".change-side option:selected").val());
		if (hasReqestedVersion){
			if(sideObj[sideId]) thisMovie("productviewer_380").changeSide(sideObj[sideId]);
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
		if(colorsObj[colorId]) thisMovie("productviewer_380").changeColor(colorsObj[colorId]);
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