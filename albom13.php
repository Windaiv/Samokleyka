<?php 
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru" dir="ltr">
<head>
<link rel="alternate" type="application/rss+xml" title="test.vedrov.ru RSS" href="http://www.liveinternet.ru/users/samokleyka/rss" />
<link rel="shortcut icon" href="favicon.gif"/>
<link rel="icon" href="favicon.gif"/>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <title>Распродажа :: test.vedrov.ru</title>
 <meta name="Description" content="Интернет магазин, наклейки, постеры, плакаты, вывески, реклама, полноцвет, интерьер"/>
 <meta name="Keywords" content="Интернет магазин, наклейки, постеры, плакаты, вывески, реклама, полноцвет, интерьер"/>
 <meta name="Reply-to" content="support@test.vedrov.ru"/>
 <meta name="robots" content="index, follow, noodp"/>
 <meta name="revisit-after" content="7 days"/>
<link rel="stylesheet" type="text/css" media="screen" href="templates/Modification/css/stylesheet_nano.min.css"/>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="templates/Modification/css/ie.css"/>
<![endif]-->
	<!-- *Скрипты анимации пролистывания 3 вкладок* -->
	<script type="text/javascript" src="templates/Modification/js/jquery-1.3.2.min.js"></script><script type="text/javascript" src="templates/Modification/js/panel.js"></script>
	<script type="text/javascript" src="templates/Modification/js/rsv.js"></script>
</head>
<body>
<!-- *верхний top-bar тонкое меню вставить <>* ?php include("templates/Blocks/top-bar.html");? -->

<!-- *верхний header* -->
<?php include("templates/Blocks/header.php");?>

<!-- *верхнее чёрное меню main-nav* -->
<?php include("templates/Blocks/main-nav.html");?>

<div id="content-wrapper">
	<div class="container_12">
	
<!-- *верхнее левое меню sub-nav* -->
<?php include("templates/Blocks/sub-nav.html");?>

		<div class="grid_9">
			<div id="content">
			<div id="content-simple">
<div class="title-desc"; align="center">
<img src="../images/albom13.png" alt="test.vedrov.ru" width="231px" height="51px"/>
</div>
<div id="main-content-bloc-infinite">
<div id="main-content-bloc-infinite-top">
<div id="main-content-bloc-infinite-bottom">

<div class="product-medium "><a href="albom13/a13_1.php" ><img src="albom13/a13_1.jpg" alt="test.vedrov.ru" width="220px" height="180px"/></a><div class="bottom-bar"><p class="product-buy-now"></p><p class="product-title">Старая цена - <b>418 руб</b></p><p class="product-price" ><a href="albom13/a13_1.php">Подробнее</a> Цена - 120 руб</p></div></div>
<div class="product-medium "><a href="albom13/a13_2.php" ><img src="albom13/a13_2.jpg" alt="test.vedrov.ru" width="220px" height="180px"/></a><div class="bottom-bar"><p class="product-buy-now"></p><p class="product-title">Старая цена - <b>426 руб</b></p><p class="product-price" ><a href="albom13/a13_2.php">Подробнее</a> Цена - 330 руб</p></div></div>
<div class="product-medium "><a href="albom13/a13_3.php" ><img src="albom13/a13_3.jpg" alt="test.vedrov.ru" width="220px" height="180px"/></a><div class="bottom-bar"><p class="product-buy-now"></p><p class="product-title">Старая цена - <b>297 руб</b></p><p class="product-price" ><a href="albom13/a13_3.php">Подробнее</a> Цена - 200 руб</p></div></div>
<div class="product-medium "><a href="albom13/a13_4.php" ><img src="albom13/a13_4.jpg" alt="test.vedrov.ru" width="220px" height="180px"/></a><div class="bottom-bar"><p class="product-buy-now"></p><p class="product-title">Старая цена - <b>288 руб</b></p><p class="product-price" ><a href="albom13/a13_4.php">Подробнее</a> Цена - 200 руб</p></div></div>
<div class="product-medium "><a href="albom13/a13_5.php" ><img src="albom13/a13_5.jpg" alt="test.vedrov.ru" width="220px" height="180px"/></a><div class="bottom-bar"><p class="product-buy-now"></p><p class="product-title">Старая цена - <b>90 руб</b></p><p class="product-price" ><a href="albom13/a13_5.php">Подробнее</a> Цена - 50 руб</p></div></div>
<div class="product-medium "><a href="albom13/a13_6.php" ><img src="albom13/a13_6.jpg" alt="test.vedrov.ru" width="220px" height="180px"/></a><div class="bottom-bar"><p class="product-buy-now"></p><p class="product-title">Старая цена - <b>295 руб</b></p><p class="product-price" ><a href="albom13/a13_6.php">Подробнее</a> Цена - 180 руб</p></div></div>
<div class="clear"></div>
</div></div></div>
<script type="text/javascript">
$(document).ready(function() {

	//Select all anchor tag with rel set to tooltip
	$('a[rel=tooltip]').mouseover(function(e) {
		
		//Grab the title attribute's value and assign it to a variable
		var tip = $(this).attr('title');	
		
		//Remove the title attribute's to avoid the native tooltip from the browser
		$(this).attr('title','');
		$(this).children('img').attr('alt','');
		
		
		//Append the tooltip template and its value
		$(this).append('<div id="tooltip"><div class="tipHeader"></div><div class="tipBody">' + tip + '</div><div class="tipFooter"></div></div>');		
				
		//Show the tooltip with faceIn effect
		$('#tooltip').fadeIn('500');
		$('#tooltip').fadeTo('0',1);
		
	}).mousemove(function(e) {
	
		//Keep changing the X and Y axis for the tooltip, thus, the tooltip move along with the mouse
		$('#tooltip').css('top', e.pageY + 10 );
		$('#tooltip').css('left', e.pageX - 100 );
		
	}).mouseout(function() {
	
		//Put back the title attribute's value
		$(this).attr('title',$('.tipBody').html());
	
		//Remove the appended tooltip template
		$(this).children('div#tooltip').remove();
		
	});

});

</script></div>			</div>
		</div>
				<div class="clearfix"></div>
	</div>	
</div>
<!-- *Нижняя чёрная часть сайта footer* -->
<?php include("templates/Blocks/footer.html");?>

</body>
</html>
