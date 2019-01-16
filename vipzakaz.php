<?php 
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru" dir="ltr">
<head>
	<!-- *RCC новости* <link rel="alternate" type="application/rss+xml" title="test.vedrov.ru RSS" href="http://www.test.vedrov.ru/samokleyka/blog/?feed=rss2" />-->
<link rel="shortcut icon" href="favicon.gif"/>
<link rel="icon" href="favicon.gif"/>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
 <title>Индивидуальный заказ - test.vedrov.ru</title>
 <meta name="Description" content="Интернет магазин наклеек для всех, Огромная коллекция разнообразных наклеек разнообразных стилей и направлений, доступно в  50 цветах и разного размера"/>
 <meta name="Keywords" content="Интернет магазин наклеек для всех, Огромная коллекция разнообразных наклеек разнообразных стилей и направлений, доступно в  50 цветах и разного размера"/>
 <meta name="Reply-to" content="support@test.vedrov.ru"/>
 <meta name="robots" content="index, follow, noodp"/>
 <meta name="revisit-after" content="7 days"/>
<link rel="stylesheet" type="text/css" media="screen" href="templates/Modification/css/stylesheet_nano.min.css"/>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="templates/Modification/css/ie.css"/>
<![endif]-->
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
<div class="title-top1">
<div class="title-top">
<table width="100%" border="1">
   <col width="160">
   <tr align="center"> 
<td>

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
<h5 align="center">Правильно указывайте Ваш почтовый ящик (Email),<br> на него придёт номер вашего заказа по которому необходимо произвести оплату.</h5>
<form name="zakaz" action="vipzakaz2.php" method="post" id="GRSubscribeForm" accept-charset="UTF-8" onsubmit="return rsv2.validate(this, rules2)"><div id="product-options">
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
	<option value="330">Южный регион - 330р.</option>
	<option value="360">Уральский регион - 360р.</option>
	<option value="380">Сибирский регион - 380р.</option>
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
	<option value="3">Наложный платеж</option>
	<option value="4">Сбербанк</option>
	<option value="5">Оплата курьеру (Пенза)</option>
	</select></b></td>
	<td><h7>   Выберите способ оплаты, подробнее можно узнать в разделе <a href="http://www.test.vedrov.ru/samokleyka/oplata.php" target="_blank">Оплата</a></h7></td>
</tr>
</table>
<![if !IE]>
  <br>
    <br>
	  <br>
	    <br>  <br>  <br>  <br>  <br>
		<![endif]>
   <p align="left"><b>Ваш адрес:</b><br>
<textarea name="adres" cols="40" rows="3"></textarea><span id="adres_second_error"></span><br><h7>Индекс, Страна, Область, Город, Улица, Корпус (если есть), Дом, Квартира</h7>
  </p>
  <p align="left"><b>Комментарий к заказу:</b><br>
<textarea name="komments" cols="40" rows="3">Вкраце опишите Ваш заказ</textarea><br><h7>А так же пожелания, дополнения, всё что Вы хотели бы нам передать.</h7>
  </p><BR>
<input type="image" src="../templates/Modification/images/buttons/french/button_in_cart.png"  border="0" alt="Заказать" title="Заказать" class="submit">
</form>

</td>
</tr>
</table> 
</div></div>
			</div>
</div>
		</div>
				<div class="clearfix"></div>
	</div>	
</div>
<!-- *Нижняя чёрная часть сайта footer* -->
<?php include("templates/Blocks/footer.html");?>

</body>
</html>
