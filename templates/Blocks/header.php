<?php
if (isset($_SESSION['mas'][0]))
{
for ($op = 0; $op < sizeof($_SESSION['mas']); $op++ )
{

}
$op=$op;
}
else
{
$op=0;
}
?>
<div id="header">
	<div class="container_13">
		<p class="site-title grid_3"><a href="http://test.vedrov.ru/samokleyka/index.php" title="В начало">test.vedrov.ru</a></p>
			<div class="small-checkout grid_4">
			<p class="cart">
			<a href="http://test.vedrov.ru/samokleyka/korzina.php">Ваши заказы <?php echo '- '.$op.'' ?> </a>
<br/>
			</p></div>
			<div class="small-checkout2 grid_4">
			<p class="contact">Тел: +7 (8412) 52-25-98<br>
							   <a href="http://test.vedrov.ru/samokleyka/polezno/info1_1.php">Как сделать заказ?</a></p>
	</div>
		<div class="clearfix"></div>
	
	</div>
</div>

