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

$komments=$_POST['komments'];

$imya=$_POST['imya'];
$fam=$_POST['fam'];
$otch=$_POST['otch'];
$adres=$_POST['adres'];
$tel=$_POST['tel'];
$mail=$_POST['mail'];
$mail2="zakaz@test.vedrov.ru";

$subject = "Ваш индивидуальный заказ принят"; 

$oplataarray = array("1" => "WebManey", "2" => "Яндекс-Деньги", "3" => "Наложный платеж", "4" => "Сбербанк", "5" => "Оплата курьеру (Пенза)");
$oplata=strtr($_POST['oplata'], $oplataarray);

$regionarray = array("0" => "Пенза (доставка бесплатная) - 0р.", "280" => "Центральный регион - 280р.", "200" => "Приволжский регион - 200р.", "340" => "Северо-Западный регион - 340р.", "330" => "Южный регион - 330р.", "360" => "Уральский регион - 360р.", "380" => "Сибирский регион - 380р.", "420" => "Дальневосточный регион - 420р.");
$region=strtr($_POST['region'], $regionarray);

$message = ' 
<html> 
    <head> 
        <title>Ваш индивидуальный заказ принят</title> 
    </head> 
    <body> 
<p>Здравствуйте, '.$fam.' '.$imya.' '.$otch.'</p><br>
<p><b>Вашему индивидуальному заказу присвоен номер: '.$count.'<b></p><br>
<p>
<b>Подробнее про способы оплаты можно узнать </b><a href="http://www.test.vedrov.ru/samokleyka/oplata.php">ЗДЕСЬ</a><br>
<b>О том, как наклеивать наклейки можно узнать </b><a href="http://www.test.vedrov.ru/samokleyka/support.php">ЗДЕСЬ</a><br>
</p>
		<p>
		<b>Если вы ничего не заказывали в нашем инетернет магазине и это письмо случайно оказалось у Вас в ящике, то отправьте пустое письмо на наш адрес:</b> support@test.vedrov.ru<br>
		</p>
		<p align="center">
По всем возникающим вопросам, Вы можете обращаться к нашим <a href="http://www.test.vedrov.ru/samokleyka/contacts.php">он-лайн консультантам</a></p>
    </body> 
</html>'; 

$headers  = "Content-type: text/html; charset=UTF-8 \r\n"; 
$headers .= "From: test.vedrov.ru <zakaz@test.vedrov.ru>\r\n"; 

$subject2 = "Принят индивидуальный заказ на test.vedrov.ru"; 

$message2 = ' 
<html> 
    <head> 
        <title>Принят индивидуальный заказ на test.vedrov.ru</title> 
    </head> 
    <body> 
<p>'.$fam.' '.$imya.' '.$otch.' - заказал индивидуальную наклейку.</p><br>
		<p><b>Его заказу присвоен номер: '.$count.'<b></p><br>
		<p>Заказчик оставил комментарий к заказу: <b><br>'.$komments.' </b></p><br>
		<p>Адрес заказчика: <b>'.$adres.' </b></p><br>
		<p>Телефон заказчика: <b>'.$tel.' </b></p><br>
		<p>Email заказчика: <b>'.$mail.' </b></p><br>
		<p>Способ оплаты: <b>'.$oplata.' </b></p><br>
		<p>Регион: <b>'.$region.' </b></p><br>
    </body> 
</html>'; 

$headers2  = "Content-type: text/html; charset=UTF-8 \r\n"; 
$headers2 .= "From: test.vedrov.ru <zakaz@test.vedrov.ru>\r\n"; 

mail($mail, $subject, $message, $headers); 
mail($mail2, $subject2, $message2, $headers2); 
session_destroy();

header('Location: index.php?add=1');
?>

