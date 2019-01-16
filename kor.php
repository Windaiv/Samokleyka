<?php 
session_start();
define( 'IPS_DOC_CHAR_SET', 'UTF-8' );
$chislo=$_POST['cart_quantity'];
$razmer=$_POST['raz'];
list($x, $y) = explode("x", $razmer);
$s=$x*$y;
$s=$s*0.0001;

if ($s>=0.0001 and $s<=0.1299)
	{$end=$s*2300;}
else{
	if ($s>=0.10 and $s<=0.1299)
	{$end=$s*2300;}
	else
		{
		if ($s>=0.13 and $s<=0.1599)
		{$end=$s*2000;}
		else
			{
			if ($s>=0.16 and $s<=0.1899)
			{$end=$s*1800;}
			else
				{
				if ($s>=0.19 and $s<=0.2199)
				{$end=$s*1600;}
				else
					{
					if ($s>=0.22 and $s<=0.2499)
					{$end=$s*1500;}
					else
						{
						if ($s>=0.25 and $s<=0.2999)
						{$end=$s*1400;}
						else
							{
							if ($s>=0.3)
							{$end=$s*1200;}
						}
					}
				}
			}
		}
	}
}
if (isset($_POST['color_2c']))
{
$end=$end*1.5;
$cena= round($end,0);
}
else
{
if ($_POST['color']=="Полноцвет" and $_POST['notebooke']!="notebooke" and $_POST['poster']!="poster")
{
$end=$end*1.2;
$cena= round($end,0);
}
else
{
if ($_POST['poster']=="poster" and $_POST['notebooke']!="notebooke")
{
$end=$end*2;
$cena= round($end,0);
}
else
{
$cena= round($end,0);
}
}
}
$suma=$end*$_POST['cart_quantity'];
$suma= round($suma,0);
if ($_POST['notebooke']=="notebooke")
{
$suma=360*$_POST['cart_quantity'];
}
if ($_POST['sale']=="sale")
{
$suma=$_POST['sale_price'];
}
if ($_POST['texton']=="texton")
{
$samtext = str_replace(' ','',$_POST['text']);
$count_text = mb_strlen($samtext,'utf-8');
$text=''.$_POST['text'].'<br><b>'.$_POST['textid'].'</b>';
$suma=$_POST['text_price']*$count_text;
$chislo=$count_text;
}
$trans_2c = array("101" => "1","102" => "2","103" => "3","104" => "4","105" => "5","106" => "6","107" => "7","108" => "8","109" => "9","110" => "10","111" => "11", "112" => "12","113" => "13","114" => "14","115" => "15","116" => "16","117" => "17","118" => "18","119" => "19","120" => "20","121" => "21","122" => "22","123" => "23","124" => "24","125" => "25","126" => "26","127" => "27","128" => "28","129" => "29","130" => "30","131" => "31","132" => "32","133" => "33","134" => "34","135" => "35","136" => "36","137" => "37","138" => "38","139" => "39","140" => "40","141" => "41","142" => "42","143" => "43","144" => "44","145" => "45","146" => "46","147" => "47","148" => "48");

$material = array("1" => "матовый","2" => "глянцевый");
$material2 = array("1" => "серебряная","2" => "золотистая");
$mat=strtr($_POST['mat'], $material);
if (isset($_POST['color_2c']))
{
$color_2c=strtr($_POST['color_2c'], $trans_2c);
}
if (isset($_POST['mat_2c']))
{
$mat_2c=strtr($_POST['mat_2c'], $material);
}
if (isset($_POST['mat2']))
{
$mat=strtr($_POST['mat'], $material);
$mat2=strtr($_POST['mat2'], $material2);
}
$mass= array("id"=>$_POST['id'],"name"=>$_POST['name'],"color"=>$_POST['color'],"color_2c"=>$color_2c,"pol"=>$_POST['pol'],"cena"=>$cena,"cart_quantity"=>$chislo,"raz"=>$razmer,"suma"=>$suma,"mat"=>$mat,"mat_2c"=>$mat_2c,"mat2"=>$mat2,"text"=>$text);

if (isset($_SESSION['mas']))
{
array_push ($_SESSION['mas'],$mass);
}
else
{
$_SESSION['mas'] = array($mass);
}
header('Location: korzina.php');
?>