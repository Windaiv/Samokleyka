<?php 
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru" dir="ltr">
<head>
	<!-- *RCC новости* <link rel="alternate" type="application/rss+xml" title="test.vedrov.ru RSS" href="http://test.vedrov.ru/samokleyka/blog/?feed=rss2" />-->
<link rel="shortcut icon" href="favicon.gif"/>
<link rel="icon" href="favicon.gif"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
 <title>Корзина товаров - test.vedrov.ru</title>
 <meta name="Description" content="Интернет магазин наклеек для всех, Огромная коллекция разнообразных наклеек разнообразных стилей и направлений, доступно в  50 цветах и разного размера"/>
 <meta name="Keywords" content="Интернет магазин наклеек для всех, Огромная коллекция разнообразных наклеек разнообразных стилей и направлений, доступно в  50 цветах и разного размера"/>
 <meta name="Reply-to" content="support@test.vedrov.ru"/>
 <meta name="robots" content="index, follow, noodp"/>
 <meta name="revisit-after" content="7 days"/>
<link rel="stylesheet" type="text/css" media="screen" href="templates/Modification/css/stylesheet_nano.min.css"/>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="templates/Modification/css/ie.css"/>
<![endif]-->
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
<?php

define( 'IPS_DOC_CHAR_SET', 'UTF-8' );
if (isset($_SESSION['mas'][0]))
{
?>
<div class="title-desc"; align="center"><h1>Подтвердите Ваш заказ:</h1>
</div>
<div class="title-top1">
<div class="title-top">

<table width="100%" border="1">
   <col width="160">
   <tr align="center"> 
<td><b>Наклейка</b></td>
	<td><b>Цвет</b></td>
		<td><b>Положение</b></td>
			<td><b>Размер</b></td>
				<td><b>Кол-во</b></td>
					<td><b>Сумма</b></td>
						<td><b>Отменить</b></td>
   </tr>
<?php
$summa=0;
for ($i = 0; $i < sizeof($_SESSION['mas']); $i++ )
{
$summa = $summa + $_SESSION['mas'][$i]["suma"];
$trans = array(
"1" => "Серно-желтый", "2" => "Золотисто-желтый", "3" => "Пастельно-оранжевый", "4" => "Светло-розовый", "5" => "Светло-красный", "6" => "Бургунди", "7" => "Лавандовый", "8" => "Фиолетовый", "9" => "Светло-голубой", "10" => "Синий", "11" => "Тёмно-синий", "12" => "Бирюзовый", "13" => "Липово-зеленый", "14" => "Зеленый", "15" => "Темно-зеленый", "16" => "Светло-коричневый", "17" => "Ореховый", "18" => "Коричневый", "19" => "Белый", "20" => "Серый", "21" => "Черный", "24" => "Малиновый", "25" => "Ярко-желтый", "26" => "Желтый", "27" => "Тёмно-красный", "28" => "Красный", "29" => "Оранжевый", "30" => "Светло-оранжевый", "31" => "Пурпурный", "32" => "Сиреневый", "33" => "Королевский-синий", "34" => "Ярко-синий", "35" => "Лазурный", "36" => "Небесно-голубой", "37" => "Голубой", "38" => "Светло-голубой", "39" => "Бирюзово-синий", "40" => "Цвет мяты", "41" => "Лесной зеленый", "42" => "Светло-зеленый", "43" => "Желто-зеленый", "44" => "Липово-зеленый", "45" => "Бежевый", "46" => "Кремовый", "47" => "Темно-серый", "48" => "Светло-серый", "50" => "Серебристо-серый", "51" => "Золотистый");
$color=strtr($_SESSION['mas'][$i]["color"], $trans);
if (isset($_SESSION['mas'][$i]["color_2c"]))
{
$color_2c=strtr($_SESSION['mas'][$i]["color_2c"], $trans);
$color='
<table width=180px border="0">
<tr align="center"> 
<td width=90px>
Цвет-1
</td>
<td width=90px>
Цвет-2
</td>
</tr>
<tr align="center"> 
<td width=90px>
<img src="../images/color/'.$_SESSION['mas'][$i]["color"].'.jpg"><br>
'.$color.'<br>
'.$_SESSION['mas'][$i]["mat"].'
</td>
<td width=90px>
<img src="../images/color/'.$_SESSION['mas'][$i]["color_2c"].'.jpg"><br>
'.$color_2c.'<br>
'.$_SESSION['mas'][$i]["mat_2c"].'
</td>
</tr>
</table>
';
}
else
{
if ($_SESSION['mas'][$i]["color"]=="Полноцвет")
{
$color='
<img src="../images/color/full.jpg"><br>
'.$color.'<br>
'.$_SESSION['mas'][$i]["mat"].'
';
}
else
{
if ($_SESSION['mas'][$i]["color"]=="Полноцветный постер")
{
$color_2c=strtr($_SESSION['mas'][$i]["color_2c"], $trans);
$color='
<table width=180px border="0">
<tr align="center"> 
<td width=90px>
Постер
</td>
<td width=90px>
Рамка
</td>
</tr>
<tr align="center"> 
<td width=90px>
'.$_SESSION['mas'][$i]["mat"].'
</td>
<td width=90px>
'.$_SESSION['mas'][$i]["mat2"].'
</td>
</tr>
</table>
';
}
else
{
$color='
<img src="../images/color/'.$_SESSION['mas'][$i]["color"].'.jpg"><br>
'.$color.'<br>
'.$_SESSION['mas'][$i]["mat"].'
';
}
}
}
if ($_SESSION['mas'][$i]["pol"]=="57")
	{$pol="Нор-ное";}
else
	{$pol="Зер-ное";}
if (isset($_SESSION['mas'][$i]["text"]))
{
$one='<p>'.$_SESSION['mas'][$i]["text"].'</p>';
}
else
{
$one='<img src="imagesm/'.$_SESSION['mas'][$i]["id"].'.png">';
}
$forma='<form name="del" action="del.php" method="post">
<input type=hidden name=n value='.$i.'>
<input type="submit" value="X">
</form>';
echo '
<tr align="center">
<td>
'.$one.'
</td>
<td>
'.$color.'
</td>
<td>
'.$pol.'
</td>
<td>
'.$_SESSION['mas'][$i]["raz"].' см.
</td>
<td>
'.$_SESSION['mas'][$i]["cart_quantity"].' шт.
</td>
<td>
'.$_SESSION['mas'][$i]["suma"].' руб.
</td>
<td>
'.$forma.'
</td>
</tr>';
}
if ($summa>=45000)
{
$sale=$summa/100*17;
$sale= round($sale,0);
$summa=$summa-$sale;
$summa= round($summa,0);
}
else
{
if ($summa>=18000)
{
$sale=$summa/100*15;
$sale= round($sale,0);
$summa=$summa-$sale;
$summa= round($summa,0);
}
else
{
if ($summa>=8000)
{
$sale=$summa/100*13;
$sale= round($sale,0);
$summa=$summa-$sale;
$summa= round($summa,0);
}
else
{
if ($summa>=5000)
{
$sale=$summa/100*10;
$sale= round($sale,0);
$summa=$summa-$sale;
$summa= round($summa,0);
}
else
{
if ($summa>=3000)
{
$sale=$summa/100*7;
$sale= round($sale,0);
$summa=$summa-$sale;
$summa= round($summa,0);
}
}
}
}
}
?>
<tr>
<td>
</td>
<td>
</td>
<td>
</td>
<td>
</td>
<td align=right>
<h5>
Скидка:
</h5>
</td>
<td align=center>
<h5>
<?php
echo '- '.$sale.'';
?>
</h5>
</td>
<td align=left>
<h5>
руб.
</h5>
</td>
</tr>
<tr>
<td>
</td>
<td>
</td>
<td>
</td>
<td>
</td>
<td align=right>
<h5>
Общая сумма:
</h5>
</td>
<td align=center>
<h5>
<?php
echo ''.$summa.'';
?>
</h5>
</td>
<td align=left>
<h5>
руб.
</h5>
</td>
</tr>
  </table> 
  <form name="add" action="index.php" method="post" align=center>
<input type="image" src="../templates/Modification/images/buttons/french/add.png"  border="0" alt="Добавить ещё" title="Добавить ещё" class="submit">
</form>
  </div>
  
<BR>

<table width="100%" border="1">
   <col width="160">
   <tr align="center"> 
<td>
<?php
echo '
<br>
		<script type="text/javascript">
rsv2.customErrorHandler = myCustomErrorDisplayFunction2;

var rules2 = [];
rules2.push("required,fam,Поле Фамилия обязательно для заполнения.");
rules2.push("required,imya,Поле Имя обязательно для заполнения.");
rules2.push("required,otch,Поле Отчество обязательно для заполнения.");
rules2.push("required,tel,Поле Телефон обязательно для заполнения.");
rules2.push("required,mail,Поле Электронная почта обязательно для заполнения.");
rules2.push("required,adres,Поле Адрес обязательно для заполнения.");
rules2.push("valid_email,mail,Пожалуйста введите корректный адрес. Пример: User@pochta.ru");

function myCustomErrorDisplayFunction2(f, errorInfo)
{
	// disabled all errors by default
	for (var i=0; i<rules2.length; i++)
	{
			var parts = rules2[i].split(",");
			var fieldName = parts[1] + "_second";

			//document.getElementById(fieldName + "_label").style.color = "#000000";
			document.getElementById(fieldName + "_error").style.display = "none";
	}

	for (var i=0; i<errorInfo.length; i++)
	{
			var fieldName;

			// radio button
			if (errorInfo[i][0].type == undefined)
					fieldName = errorInfo[i][0][0].name;
			else
					fieldName = errorInfo[i][0].name;
			
			fieldName = fieldName + "_second";

			// display the error
			document.getElementById(fieldName + "_error").style.display = "block";
			document.getElementById(fieldName + "_error").innerHTML = errorInfo[i][1];
			
	}

	return (errorInfo.length == 0) ? true : false;

	return false;
}
</script>
<h5 align="center">Правильно указывайте Ваш почтовый ящик (Email),<br> на него придёт номер вашего заказа и инструкция по оплате.</h5>
<form name="zakaz" action="zakaz.php" method="post" id="GRSubscribeForm" accept-charset="UTF-8" onsubmit="return rsv2.validate(this, rules2)"><div id="product-options">
<table align="left">
   <col width="140">
<tr align="left"> 
	<td><b>Фамилия:</b></td>
	<td><b><input name="fam" type="text" maxLength="20" size="20"></b></td>
	<td width="440"><h8><span id="fam_second_error"></span></h8></td>
</tr>

<tr align="left"> 
	<td><b>Имя:</b></td>
	<td><b><input name="imya" type="text" maxLength="20" size="20"></b></td>
	<td><h8><span id="imya_second_error"></span></h8></td>
</tr>

<tr align="left"> 
	<td><b>Отчество:</b></td>
	<td><b><input name="otch" type="text" maxLength="20" size="20"></b></td>
	<td><h8><span id="otch_second_error"></span></h8></td>
</tr>

<tr align="left"> 
	<td><b>Телефон:</b></td>
	<td><b><input name="tel" type="text" maxLength="50" size="20" value="+0(000)00-00-00"></b></td>
	<td><h8><span id="tel_second_error"></span></h8></td>
</tr>

<tr align="left"> 
	<td><b>Почтовый ящик:</b></td>
	<td><b><input name="mail" type="text" size="20"></b></td>
	<td><br><h8><span id="mail_second_error"></span></h8></td>
</tr>
<tr align="left"> 
	<td><b>Ваш регион:</b></td>
	<td><b>
	<select name="region" id="region">
	<option value="0">Пенза (доставка бесплатная) - 0р.</option>
	<option value="280">Центральный регион - 280р.</option>
	<option value="200">Приволжский регион - 200р.</option>
	<option value="340">Северо-Западный регион - 340р.</option>
	<option value="250">Южный регион - 250р.</option>
	<option value="360">Уральский регион - 360р.</option>
	<option value="300">Сибирский регион - 300р.</option>
	<option value="420">Дальневосточный регион - 420р.</option>
	</select></b></td>
	<td><h7>   Плата за почтовые услуги</h7></td>
</tr>
<tr align="left"> 
	<td><b>Способ оплаты:</b></td>
	<td><b>
	<select name="oplata" id="oplata">
	<option value="1">WebManey</option>
	<option value="2">Яндекс-Деньги</option>
	<option value="3">Наложенный платеж</option>
	<option value="4">Сбербанк</option>
	<option value="5">Оплата курьеру (Пенза)</option>
	</select></b></td>
	<td><h7>   Выберите способ оплаты, подробнее можно узнать в разделе <a href="http://test.vedrov.ru/samokleyka/oplata.php" target="_blank">Оплата</a></h7></td>
</tr>
<tr align="left"> 
	<td><b>Сертификат:</b></td>
	<td>
	<select name="ser" id="ser">
	<option value="0">нет</option>
	<option value="300">300 р.</option>
	<option value="400">400 р.</option>
	<option value="500">500 р.</option>
	</select>
	<td><b>Номер сертификата <input name="sernom" type="text" size="6"></b></td>
	</td>

</tr>
</table>
<![if !IE]>
  <br>
    <br>
	  <br>
	    <br>  <br>  <br>  <br>  <br>
		<![endif]>
   <p align="left"><b>Ваш адрес:</b><br>
<textarea name="adres" cols="40" rows="3"></textarea><h8><span id="adres_second_error"></span></h8><br><h7>Индекс, Страна, Область, Город, Улица, Корпус (если есть), Дом, Квартира</h7>
  </p>
  <p align="left"><b>Комментарий к заказу:</b><br>
<textarea name="komments" cols="40" rows="3">Заполняется по необходимости</textarea><br><h7>Пожелания, дополнения, всё что Вы хотели бы нам передать.</h7>
  </p><BR>
  <input type=hidden name=summa value="'.$summa.'">
  <input type=hidden name=sale value="'.$sale.'">
<input type="image" src="../templates/Modification/images/buttons/french/button_in_cart.png"  border="0" alt="Заказать" title="Заказать" class="submit">

</form>
<form name="otmena" action="otmena.php" method="post">
<input type="image" src="../templates/Modification/images/buttons/french/otmena.png"  border="0" alt="Удалить заказ" title="Удалить заказ" class="submit">
</form>'
;
?>
</td>
</tr>
</table> 

<?php
}
else
{
?>
<div class="title-top1">
<div class="title-top">

<H2 align=center><br>Вы не выбрали товар!</H2><br>
<h4 align=center>Для заказа наклейки вам необходимо выбрать понравившуюся тематику из меню.</h4>
</div></div></div><div class="clearfix">
<?php
}
?>

</div>

</div>			</div>
		</div>
				<div class="clearfix"></div>
	</div>	
</div>
<!-- *Нижняя чёрная часть сайта footer* -->
<?php include("templates/Blocks/footer.html");?>

</body>
</html>
