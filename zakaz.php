<?php
session_start();
define( 'IPS_DOC_CHAR_SET', 'UTF-8' );

$file=fopen("colzak.txt","a+");
flock($file,LOCK_EX); 
$count=fread($file,100);
$count++; 
ftruncate($file,0); 
fwrite($file,$count); 
flock($file,LOCK_UN); 
fclose($file); 


$summa=$_POST['summa']-$_POST['ser'];
if ($summa<=0)
{
$summa=$_POST['region'];
}
else
{
$summa=$_POST['summa']+$_POST['region']-$_POST['ser'];
}
$sale=$_POST['sale'];
$komments=$_POST['komments'];


$imya=$_POST['imya'];
$fam=$_POST['fam'];
$otch=$_POST['otch'];
$adres=$_POST['adres'];
$tel=$_POST['tel'];
$mail=$_POST['mail'];
$mail2="zakaz@test.vedrov.ru";

$oplataarray = array("1" => "WebManey", "2" => "Яндекс-Деньги", "3" => "Наложный платеж", "4" => "Сбербанк", "5" => "Оплата курьеру (Пенза)");
$oplata=strtr($_POST['oplata'], $oplataarray);

$ser=$_POST['ser'];
$sernom=$_POST['sernom'];
$sertifikat='';
if ($ser!=0)
{
$sertifikat='
<tr align="center">
<td>
</td>
<td>
</td>
<td>
</td>
<td>
</td>
<td align=right>
Сертификат:
</td>
<td>
'.$_POST['ser'].' руб.
</td>
</tr>';
}
$subject = "Ваш заказ принят"; 
$region='
<tr align="center">
<td>
</td>
<td>
</td>
<td>
</td>
<td>
</td>
<td align=right>
Стоимость пересылки:
</td>
<td>
'.$_POST['region'].' руб.
</td>
</tr>';
for ($i = 0; $i < sizeof($_SESSION['mas']); $i++ )
{
$trans = array(
"1" => "Серно-желтый", "2" => "Золотисто-желтый", "3" => "Пастельно-оранжевый", "4" => "Светло-розовый", "5" => "Светло-красный", "6" => "Бургунди", "7" => "Лавандовый", "8" => "Фиолетовый", "9" => "Светло-голубой", "10" => "Синий", "11" => "Тёмно-синий", "12" => "Бирюзовый", "13" => "Липово-зеленый", "14" => "Зеленый", "15" => "Темно-зеленый", "16" => "Светло-коричневый", "17" => "Ореховый", "18" => "Коричневый", "19" => "Белый", "20" => "Серый", "21" => "Черный", "24" => "Малиновый", "25" => "Ярко-желтый", "26" => "Желтый", "27" => "Тёмно-красный", "28" => "Красный", "29" => "Оранжевый", "30" => "Светло-оранжевый", "31" => "Пурпурный", "32" => "Сиреневый", "33" => "Королевский-синий", "34" => "Ярко-синий", "35" => "Лазурный", "36" => "Небесно-голубой", "37" => "Голубой", "38" => "Светло-голубой", "39" => "Бирюзово-синий", "40" => "Цвет мяты", "41" => "Лесной зеленый", "42" => "Светло-зеленый", "43" => "Желто-зеленый", "44" => "Липово-зеленый", "45" => "Бежевый", "46" => "Кремовый", "47" => "Темно-серый", "48" => "Светло-серый", "50" => "Серебристо-серый", "51" => "Золотистый",);
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
<img src="http://test.vedrov.ru/samokleyka/images/color/'.$_SESSION['mas'][$i]["color"].'.jpg"><br>
'.$color.'<br>
'.$_SESSION['mas'][$i]["mat"].'
</td>
<td width=90px>
<img src="http://test.vedrov.ru/samokleyka/images/color/'.$_SESSION['mas'][$i]["color_2c"].'.jpg"><br>
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
<img src="http://test.vedrov.ru/samokleyka/images/color/full.jpg"><br>
'.$color.'<br>
'.$_SESSION['mas'][$i]["mat"].'
';
}
else
{
$color='
<img src="http://test.vedrov.ru/samokleyka/images/color/'.$_SESSION['mas'][$i]["color"].'.jpg"><br>
'.$color.'<br>
'.$_SESSION['mas'][$i]["mat"].'
';
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
$one='<img src="http://test.vedrov.ru/samokleyka/imagesm/'.$_SESSION['mas'][$i]["id"].'.png">';
}
$fog .='
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
</tr>';
}

$message = ' 
<html> 
    <head> 
        <title>Ваш заказ принят</title> 
    </head> 
    <body> 
<p>Здравствуйте, '.$fam.' '.$imya.' '.$otch.'</p><br>
		<p><b>Вашему заказу присвоен номер: '.$count.'<b></p><br>
		<p>Список выбранных наклеек:<br>
		<table width="100%" border="1">
   <col width="160">
   <tr align="center"> 
<td><b>Наклейка</b></td>
    <td><b>Цвет</b></td>
		<td><b>Положение</b></td>
			<td><b>Размер</b></td>
				<td><b>Количество</b></td>
					<td><b>Сумма</b></td>
   </tr>
'.$fog.'
'.$region.'
'.$sertifikat.'
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
<h>
Скидка:
</h>
</td>
<td align=center>
<b>- '.$sale.' руб.</b>
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
<h>
Общая сумма:
</h>
</td>
<td align=center>
<b>'.$summa.' руб.</b>
</td>
</tr>
  </table>
  <b>Подробнее про выбранный Вами способ оплаты можно узнать </b><a href="http://test.vedrov.ru/samokleyka/oplata.php">ЗДЕСЬ</a><br>
  <b>О том, как наклеивать наклейки можно узнать </b><a href="http://test.vedrov.ru/samokleyka/support.php">ЗДЕСЬ</a><br>
		</p>
		<p>
		<b>Если вы ничего не заказывали в нашем инетернет магазине и это письмо случайно оказалось у Вас в ящике, то отправьте пустое письмо на наш адрес:</b> support@test.vedrov.ru<br>
		</p>
		<p align="center">
По всем возникающим вопросам, Вы можете обращаться к нашим <a href="http://test.vedrov.ru/samokleyka/contacts.php">он-лайн консультантам</a></p>
    </body> 
</html>'; 

$headers  = "Content-type: text/html; charset=UTF-8 \r\n"; 
$headers .= "From: test.vedrov.ru <zakaz@test.vedrov.ru>\r\n"; 

$subject2 = "Принят заказ на test.vedrov.ru"; 

$message2 = ' 
<html> 
    <head> 
        <title>Принят заказ на test.vedrov.ru</title> 
    </head> 
    <body> 
<p>'.$fam.' '.$imya.' '.$otch.' - заказал наклейки.</p><br>
		<p><b>Его заказу присвоен номер: '.$count.'<b></p><br>
		<p>Список выбранных наклеек:<br>
		<table width="100%" border="1">
   <col width="160">
   <tr align="center"> 
<td><b>Наклейка</b></td>
    <td><b>Цвет</b></td>
		<td><b>Положение</b></td>
			<td><b>Размер</b></td>
				<td><b>Количество</b></td>
					<td><b>Сумма</b></td>
   </tr>
		'.$fog.'
'.$region.'
'.$sertifikat.'
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
<h>
Скидка:
</h>
</td>
<td align=center>
<b>- '.$sale.' руб.</b>
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
<td align=right rowspan="2">
<h>
Общая сумма:
</h>
</td>
<td align=center>
<b>'.$summa.' руб.</b>
</td>
</tr>
  </table>
		</p>
		<p>Заказчик оставил комментарий к заказу: <b><br>'.$komments.' </b></p><br>
		<p>Адрес заказчика: <b>'.$adres.' </b></p><br>
		<p>Телефон заказчика: <b>'.$tel.' </b></p><br>
		<p>Email заказчика: <b>'.$mail.' </b></p><br>
		<p>Способ оплаты: <b>'.$oplata.' </b></p><br>
		<p>Сертификат на сумму: <b>'.$ser.' </b> Номер сертификата: <b>'.$sernom.' </b></p><br>
    </body> 
</html>'; 

$headers2  = "Content-type: text/html; charset=UTF-8 \r\n"; 
$headers2 .= "From: test.vedrov.ru <zakaz@test.vedrov.ru>\r\n"; 

mail($mail, $subject, $message, $headers); 
mail($mail2, $subject2, $message2, $headers2); 
session_destroy();

header('Location: index.php?add=1');
?>

