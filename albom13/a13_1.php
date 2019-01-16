<?php
session_start();
?>
<?php 
$url=basename($_SERVER['PHP_SELF']);
$idnomer= substr($url,0,-4);
$urlx=explode("_", $idnomer);
$back=''.$urlx[0].'_'.($urlx[1]-1).'';
$next=''.$urlx[0].'_'.($urlx[1]+1).'';
$nomfoto= $urlx[1];
$namefoto='Распродажа-'.$nomfoto.'';
$raz=getimagesize('images/'.$idnomer.'.png');
$start[0]=20;
$mas0=$start[0];
$mas1=$start[0]+5;
$mas2=$start[0]+10;
if ($raz[0]<$raz[1])
{
$height=array ($mas0,$mas1,$mas2);
$h1=$raz[0]/$height[0];
$width[0]=ceil ($raz[1]/$h1);
$h2=$raz[0]/$height[1];
$width[1]=ceil ($raz[1]/$h2);
$h3=$raz[0]/$height[2];
$width[2]=ceil ($raz[1]/$h3);
}
else
{
$height=array ($mas0,$mas1,$mas2);
$h1=$raz[1]/$height[0];
$width[0]=ceil ($raz[0]/$h1);
$h2=$raz[1]/$height[1];
$width[1]=ceil ($raz[0]/$h2);
$h3=$raz[1]/$height[2];
$width[2]=ceil ($raz[0]/$h3);
}
for ($i = 0; $i < 3; $i++ )
{
include("../formula_poster.html");
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru" dir="ltr">
<head>
<link rel="alternate" type="application/rss+xml" title="test.vedrov.ru RSS" href="http://www.liveinternet.ru/users/samokleyka/rss" />
<link rel="shortcut icon" href="http://www.test.vedrov.ru/samokleyka/favicon.gif"/>
<link rel="icon" href="http://www.test.vedrov.ru/samokleyka/favicon.gif"/>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <title><?=$namefoto?> :: test.vedrov.ru</title>
 <meta name="Description" content="Интернет-каталог наклеек для всех, наклейка <?=$namefoto?> из нашего каталога для декорирования интерьера Вашей квартиры!"/>
 <meta name="Keywords" content="Интернет-каталог наклеек для всех, наклейка <?=$namefoto?> из нашего каталога для декорирования интерьера Вашей квартиры!"/>
 <meta name="Reply-to" content="support@test.vedrov.ru"/>
 <meta name="robots" content="index, follow, noodp"/>
 <meta name="revisit-after" content="7 days"/>
<link rel="stylesheet" type="text/css" media="screen" href="../templates/Modification/css/stylesheet_nano.min.css"/>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="..//templates/Modification/css/ie.css"/>
<![endif]-->
	<!-- *Скрипты анимации пролистывания 3 вкладок* -->
	<script type="text/javascript" src="../templates/Modification/js/jquery-1.3.2.min.js"></script><script type="text/javascript" src="../templates/Modification/js/panel.js"></script>
	<script type="text/javascript" src="../templates/Modification/js/rsv.js"></script>
</head>
<body>
<!-- *верxний top-bar тонкое меню вставить <>* ?php include("templates/Blocks/top-bar.html");? -->

<!-- *верxний header* -->
<?php include("../templates/Blocks/header.php");?>

<!-- *верxнее чёрное меню main-nav* -->
<?php include("../templates/Blocks/main-nav.html");?>

<div id="content-wrapper">
	<div class="container_12">
	
<!-- *верxнее левое меню sub-nav* -->
<?php include("../templates/Blocks/sub-nav.html");?>

		<div class="grid_9">
			<div id="content">
			<div id="main-content-bloc-infinite">
<div id="main-content-bloc-infinite-top">
<div id="main-content-bloc-infinite-bottom">
<div id="product-info">
<div id="product-buy">
<div id="product-main">
<div id="product-main-title">
<h1><?=$namefoto?></h1>
<p class="price-top">120 руб.</p>
</div>
	<!-- *контент flash* -->
<div id="flash" style="background-image:url(images/<?echo ''.$idnomer.'';?>.png);">	
</div>
	</div>

<form name="cart_quantity" action="../kor.php" method="post"><div id="product-options">
<input type=hidden name=name value=<?=$namefoto?>>
<input type=hidden name=id value=<?=$idnomer?>>
<div id="options-content">

	<!-- *контент options* -->
<label>Цвет:</label>
<select name="color" class="change-color">
<option value="8" selected alt="0.0000">фиолетовый </option>
</select>
<label>Материал:</label><select name="mat" class="mat"><option value="1"  alt="0.0000">матовый </option></select>
<label>Положение:</label><select name="pol" class="change-side"><option value="57"  alt="0.0000">нормальное </option></select>
<input type="hidden" name="sale" value="sale">
<script type="text/javascript">
				$(document).ready(function () {	
					
					var qty = parseInt($("#product-quantity option:selected").attr("value"));
					var qt = parseFloat($("#product-size option:selected").attr("value1"));
					var totalPrice = qty * qt;
					$("#product-total-price").empty();
					$("#product-total-price").append(totalPrice + " руб");
			
					$("#product-quantity").change(function() {
						qty = parseInt($("#product-quantity option:selected").attr("value"));
						qt = parseFloat($("#product-size option:selected").attr("value1"));
						totalPrice = qty * qt;
						$("#product-total-price").empty();
						$("p.price-top").empty();
						$("#product-total-price").append(totalPrice + " руб");
						$("p.price-top").append(totalPrice + " руб");
					});	
					
					$("#product-size").change(function() {
						qty = parseInt($("#product-quantity option:selected").attr("value"));
						qt = parseFloat($("#product-size option:selected").attr("value1"));
						totalPrice = qty * qt;
						$("#product-total-price").empty();
						$("p.price-top").empty();
						$("#product-total-price").append(totalPrice + " руб");
						$("p.price-top").append(totalPrice + " руб");
					});	
										
				});
			</script>
<label>Размер :</label>
<select name="raz" class="change-side" id="product-size">
<option value="40x20" value1="120">40x20 см.</option>
</select>
<p class="option-infos">* Цвет, размер, материал наклейки изменить нельзя.</p>			

<label>Количество : </label>
<select name="cart_quantity" id="product-quantity">
<option value="1">1</option>
</select>
<input type="hidden" name="sale_price" value="120">
<p> = 120 руб.</p>
</div>

<input type="image" src="../templates/Modification/images/buttons/french/button_in_cart_text.gif"  border="0" alt="Добавить в корзину" title="Добавить в корзину" class="submit">

</div><div class="clear"></div></div>	
	<div id="product-more-infos">
<div id="product-image" align="center"><img src="images/<?=$idnomer?>.jpg" alt="Большой пример постера" /></div>
	</div>
<br>
<table width="100%">
<tr>
<td width="50%" align="left">
<a href="http://www.test.vedrov.ru/samokleyka/albom13.php">
<img src="http://www.test.vedrov.ru/samokleyka/templates/Modification/images/buttons/french/catalog.png"
alt="Каталог" width="103" height="43" border="0" /></a>
</td>
<td  width="50%" align="right">
<a href="http://www.test.vedrov.ru/samokleyka/albom13/<?=$next?>.php">
<img src="http://www.test.vedrov.ru/samokleyka/templates/Modification/images/buttons/french/next.png"
alt="Дальше" width="103" height="43" border="0" /></a>
</td>
</tr>
</table>
	</form>

</div>
</div>
</div>
</div>
			</div>
		</div>
				<div class="clearfix"></div>
	</div>	
</div>

<!-- *Нижняя чёрная часть сайта footer* -->
<?php include("../templates/Blocks/footer.html");?>

</body>
</html>
