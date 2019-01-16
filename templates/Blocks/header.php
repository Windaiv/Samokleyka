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
		<p class="site-title grid_3"><a href="http://www.samokleyka.net/index.php" title="В начало">Samokleyka.net</a></p>
			<div class="small-checkout grid_4">
			<p class="cart">
			<a href="http://www.samokleyka.net/korzina.php">Ваши заказы <?php echo '- '.$op.'' ?> </a>
<br/>
			</p></div>
			<div class="small-checkout2 grid_4">
			<p class="contact">Тел: +7 (8412) 52-25-98<br>
							   <a href="http://www.samokleyka.net/polezno/info1_1.php">Как сделать заказ?</a></p>
	</div>
		<div class="clearfix"></div>
	
	</div>
</div>

