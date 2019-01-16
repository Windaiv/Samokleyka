function thisMovie(movieName) {
	var isIE = navigator.appName.indexOf("Microsoft") != -1;
	return document[movieName];
}
	
var colorsObj = {1:"0xFAF708",
				3:"0xFFB901",
				4:"0xFF8601",
				5:"0xF6A6BF",
				69:"0xCD0567",
				7:"0xD62901",
				8:"0x670001",
				9:"0x7C7DBD",
				10:"0x4B176C",
				11:"0x4998B7",
				12:"0x025285",
				13:"0x100553",
				14:"0x04947B",
				15:"0x6B9D00",
				59:"0x007C3E",
				60:"0x015836",
				61:"0xB58937",
				62:"0xCE7318",
				63:"0x4D2501",
				64:"0xFFFFFF",
				65:"0xA4AEAD",
				66:"0x000000",
				67:"0xA8B1B8",
				68:"0xB38808"};

var fontObj = { 195: "kid_print",
				194: "impact",
				193: "arno_pro",
				196: "insula",
				192: "century_gothic",
				215: "monotype_corsiva",
				216: "eurofurence",
				217: "mistral",
				325: "comic_sans_ms",
				326: "courier_new",
				329: "segoe_print",
				327: "fmbf_bardi",
				328: "franklin_gothic_book"};

var sizeObj = { 197: "6",
				198: "12",
				199: "18",
				200: "24"};
				
var nbLettersObj = { 1: "223",
					10: "232",
					100: "322",
					11: "233",
					12: "234",
					13: "235",
					14: "236",
					15: "237",
					16: "238",
					17: "239",
					18: "240",
					19: "241",
					2: "224",
					20: "242",
					21: "243",
					22: "244",
					23: "245",
					24: "246",
					25: "247",
					26: "248",
					27: "249",
					28: "250",
					29: "251",
					3: "225",
					30: "252",
					31: "253",
					32: "254",
					33: "255",
					34: "256",
					35: "257",
					36: "258",
					37: "259",
					38: "260",
					39: "261",
					4: "226",
					40: "262",
					41: "263",
					42: "264",
					43: "265",
					44: "266",
					45: "324",
					46: "268",
					47: "269",
					48: "270",
					49: "271",
					5: "227",
					50: "272",
					51: "273",
					52: "274",
					53: "275",
					54: "276",
					55: "277",
					56: "278",
					57: "279",
					58: "280",
					59: "281",
					6: "228",
					60: "282",
					61: "283",
					62: "284",
					63: "285",
					64: "286",
					65: "287",
					66: "288",
					67: "289",
					68: "290",
					69: "291",
					7: "229",
					70: "292",
					71: "293",
					72: "294",
					73: "295",
					74: "296",
					75: "297",
					76: "298",
					77: "299",
					78: "300",
					79: "301",
					8: "230",
					80: "302",
					81: "303",
					82: "323",
					83: "305",
					84: "306",
					85: "307",
					86: "308",
					87: "309",
					88: "310",
					89: "311",
					9: "231",
					90: "312",
					91: "313",
					92: "314",
					93: "315",
					94: "316",
					95: "317",
					96: "318",
					97: "319",
					98: "320",
					99: "321"};

$(document).ready(function () {
	
	$(".change-color").change(function() {
		colorId = parseInt($(".change-color option:selected").val());
		if(colorsObj[colorId]) thisMovie("productviewer_custom").changeColor(colorsObj[colorId]);
		SelectColorSquare(".nuancier1", colorId);
	});
	
	$(".change-text-font").change(function() {
		fontId = parseInt($(".change-text-font option:selected").val());	
		if(fontObj[fontId])
			thisMovie("productviewer_custom").changeTextFont(fontObj[fontId]);
	});
	
	$(".change-text-size").change(function() {
		sizeId = parseInt($(".change-text-size option:selected").val());	
		if(sizeObj[sizeId])
			thisMovie("productviewer_custom").changeTextSize(sizeObj[sizeId]);
	});
	/*
	$(".change-text").keyup(function() {
		var countLimit = "200";
		var textBox = $(".change-text");
		var textValue = textBox.val();
		var len = textValue.replace(/ /g, "");
		var nbCaracteres = len.length;	
		
		$(".change-text-length").val(nbLettersObj[nbCaracteres]);		
		
		if(textValue.length > countLimit){
			textValue = textValue.substring(0,countLimit);
			textBox.val(textValue);
		}
		
		thisMovie("productviewer_custom").changeText(textValue);			
	});
	*/
});

function SelectColorSquare(div, id){
	$("div > a").removeClass("selected");
	$("div > a#" + id).addClass("selected");
}

function capture(imageUniqueId){
	thisMovie("productviewer_custom").capture(imageUniqueId);
}