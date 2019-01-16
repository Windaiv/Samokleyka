<p align=center>
<?php 

if (isset($_POST['x']))
{
$x=$_POST['x'];
echo 'Высота = '.$x.'см.<br>';
$y=$_POST['y'];
echo 'Ширина = '.$y.'см.<br>';
$s=$x*$y;
$s=$s*0.0001;
echo 'Площадь = '.$s.'м2.<br>';
if ($s>=0.0001 and $s<=0.1299)
	{$end=$s*120; echo'1 ценовая категория';}
else{
	if ($s>=0.10 and $s<=0.1299)
	{$end=$s*120; echo'2 ценовая категория';}
	else
		{
		if ($s>=0.13 and $s<=0.1599)
		{$end=$s*122; echo'3 ценовая категория';}
		else
			{
			if ($s>=0.16 and $s<=0.1899)
			{$end=$s*124; echo'4 ценовая категория';}
			else
				{
				if ($s>=0.19 and $s<=0.2199)
				{$end=$s*126; echo'5 ценовая категория';}
				else
					{
					if ($s>=0.22 and $s<=0.2499)
					{$end=$s*128; echo'6 ценовая категория';}
					else
						{
						if ($s>=0.25 and $s<=0.2999)
						{$end=$s*130; echo'7 ценовая категория';}
						else
							{
							if ($s>=0.3)
							{$end=$s*135; echo'8 ценовая категория';}
						}
					}
				}
			}
		}
	}
}
if ($_POST['cc']==1)
{
$end=$end*1.5;
$end= round($end,0);
echo '<br>Маленькие<br>';
}
else
{
if ($_POST['cc']==3)
{
$end=$end*1.2;
$end= round($end,0);
echo '<br>Средние<br>';
}
else
{
$end= round($end,0);
echo '<br>Большие<br>';
}
}
echo 'Стоимость = '.$end.' руб.<br>';
if ($end>=50000)
{
$sale=$end/100*17;
$sale= round($sale,0);
$end=$end-$sale;
$end= round($end,0);
echo 'Скидка = 17% '.$sale.' руб.<br>';
echo '<b>Итоговая стоимость = '.$end.' руб.</b><br>';
}
else
{
if ($end>=20000)
{
$sale=$end/100*15;
$sale= round($sale,0);
$end=$end-$sale;
$end= round($end,0);
echo 'Скидка = 15% '.$sale.' руб.<br>';
echo '<b>Итоговая стоимость = '.$end.' руб.</b><br>';
}
else
{
if ($end>=10000)
{
$sale=$end/100*13;
$sale= round($sale,0);
$end=$end-$sale;
$end= round($end,0);
echo 'Скидка 13% = '.$sale.' руб.<br>';
echo '<b>Итоговая стоимость = '.$end.' руб.</b><br>';
}
else
{
if ($end>=7000)
{
$sale=$end/100*10;
$sale= round($sale,0);
$end=$end-$sale;
$end= round($end,0);
echo 'Скидка 10% = '.$sale.' руб.<br>';
echo '<b>Итоговая стоимость = '.$end.' руб.</b><br>';
}
else
{
if ($end>=5000)
{
$sale=$end/100*7;
$sale= round($sale,0);
$end=$end-$sale;
$end= round($end,0);
echo 'Скидка 7% = '.$sale.' руб.<br>';
echo '<b>Итоговая стоимость = '.$end.' руб.</b><br>';
}
}
}
}
}
if (isset($_POST['r']))
{
$end2=$_POST['n']+$end+$_POST['r'];
echo '<b>Общая сумма = '.$end2.' руб.</b><br>';
}
else
{
$end2=$_POST['n']+$end;
echo '<b>Общая сумма = '.$end2.' руб.</b><br>';
}
}
else
{
echo 'Введите данные'; 
}
?>
<form name="ploshad" action="koren2.php" method="post" align=center>
<?
if ($end>0)
{
echo'<input type=hidden name=n value='.$end2.'>';
}
else
{
echo'<input type=hidden name=n value="0">';
}
?>
Высота: <input type=text name="x"> см.<br>
Ширина: <input type=text name="y"> см.<br>
Размер: 
Маленькие<INPUT TYPE=RADIO NAME=cc VALUE="1"> - 
Средние<INPUT TYPE=RADIO NAME=cc VALUE="3"> - 
Большие<INPUT TYPE=RADIO NAME=cc VALUE="2"> <br>
Работа: <input type=text name="r"> руб.<br>
<input type="submit" value="Посчитать">
</form>
</p>