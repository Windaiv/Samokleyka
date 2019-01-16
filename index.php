<?php 
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru" dir="ltr">
<head>
<link rel="alternate" type="application/rss+xml" title="test.vedrov.ru RSS" href="http://www.liveinternet.ru/users/samokleyka/rss" />
<link rel="shortcut icon" href="favicon.gif"/>
<link rel="icon" href="favicon.gif"/>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
 <title>Виниловые наклейки для декора стен, мебели, авто, ноутбуков :: test.vedrov.ru</title>
 <meta name="Description" content="Интернет-каталог наклеек для декора стен, мебели, автомобилей, ноутбуков"/>
 <meta name="Keywords" content="Интернет магазин наклеек для всех, Огромная коллекция разнообразных наклеек разнообразных стилей и направлений, доступно в  50 цветах и разного размера для необыкновенного и  индивидуального интерьера, Наклейки для интерьера, test.vedrov.ru, наклейки на стены, стикеры на стены, дизайн интерьера, наклейки для стен"/>
 <meta name="Reply-to" content="support@test.vedrov.ru"/>
 <meta name="robots" content="index, follow"/>
 <meta name="revisit-after" content="7 days"/>
<link rel="stylesheet" type="text/css" media="all" href="templates/Modification/css/stylesheet_nano.min.css"/>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="templates/Modification/css/ie.css"/>
<![endif]-->
	<!-- *Скрипты анимации пролистывания 3 вкладок* -->
	<script type="text/javascript" src="templates/Modification/js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="templates/Modification/js/panel.js"></script>
<meta name="google-site-verification" content="UYso_OMUAl-rcvsgu62dRYHaqm9-daX_6awCkiEoNT8" />
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
<?php
if (isset($_GET['add']))
{
?>
<div id="main-content-bloc-infinite">
<div id="main-content-bloc-infinite-top">
<div id="main-content-bloc-infinite-bottom"> 
<h4 align=center><br>Ваш заказ принят, на указанную почту придёт письмо с инструкцией по оплате.</h4>
</div>
</div>
</div>

<?php
}
?>

<div id="main-content-bloc-infinite">
<div id="main-content-bloc-infinite-top">
<div id="main-content-bloc-infinite-bottom"> 
<!-- *слайдер на главной странице* -->	

<script type="text/javascript">

var Book_Image_Width=360;
var Book_Image_Height=191;
var Book_Border=false;
var Book_Border_Color="gray";
var Book_Speed=15;
var Book_NextPage_Delay=1500; //1 second=1000
var Book_Vertical_Turn=0;

Book_Image_Sources=new Array(
"images/slider/al1.jpg","http://test.vedrov.ru/samokleyka/albom10.php",
"images/slider/al2.jpg","http://test.vedrov.ru/samokleyka/albom9.php",
"images/slider/al3.jpg","http://test.vedrov.ru/samokleyka/albom11.php", 
"images/slider/al4.jpg","http://test.vedrov.ru/samokleyka/albom12.php", 
"images/slider/al5.jpg","http://test.vedrov.ru/samokleyka/blog/stati/vinilovye-naklejki/vyveska-na-dom",
"images/slider/al6.jpg","http://test.vedrov.ru/samokleyka/albom6.php",
"images/slider/al7.jpg","http://test.vedrov.ru/samokleyka/uslugi/tablo.php", 
"images/slider/al8.jpg","http://test.vedrov.ru/samokleyka/uslugi/na_dver.php" 
);


var B_LI,B_MI,B_RI,B_TI,B_Angle=0,B_CrImg=6,B_MaxW,B_Direction=1;
var B_MSz,B_Stppd=false;B_Pre_Img=new Array(Book_Image_Sources.length);

function ImageBook(){
if(document.getElementById){
for(i=0;i<Book_Image_Sources.length;i+=2){
B_Pre_Img[i]=new Image();B_Pre_Img[i].src=Book_Image_Sources[i]}
Book_Div=document.getElementById("Book");
B_LI=document.createElement("img");Book_Div.appendChild(B_LI);
B_RI=document.createElement("img");Book_Div.appendChild(B_RI);
B_MI=document.createElement("img");Book_Div.appendChild(B_MI);
B_LI.style.position=B_MI.style.position=B_RI.style.position="absolute";
B_LI.style.zIndex=B_RI.style.zIndex=0;B_MI.style.zIndex=1;
B_LI.style.top=(Book_Vertical_Turn?Book_Image_Height+1:0)+"px";
B_LI.style.left=0+"px";
B_MI.style.top=0+"px";
B_MI.style.left=(Book_Vertical_Turn?0:Book_Image_Width+1)+"px";
B_RI.style.top=0+"px";
B_RI.style.left=(Book_Vertical_Turn?0:Book_Image_Width+1)+"px";
B_LI.style.height=Book_Image_Height+"px";
B_MI.style.height=Book_Image_Height+"px";
B_RI.style.height=Book_Image_Height+"px";
B_LI.style.width=Book_Image_Width+"px";
B_MI.style.width=Book_Image_Width+"px";
B_RI.style.width=Book_Image_Width+"px";
if(Book_Border){
B_LI.style.borderStyle=B_MI.style.borderStyle=B_RI.style.borderStyle="solid";
B_LI.style.borderWidth=1+"px";
B_MI.style.borderWidth=1+"px";
B_RI.style.borderWidth=1+"px";
B_LI.style.borderColor=B_MI.style.borderColor=B_RI.style.borderColor=Book_Border_Color}
B_LI.src=B_Pre_Img[0].src;
B_LI.lnk=Book_Image_Sources[1];
B_MI.src=B_Pre_Img[2].src;
B_MI.lnk=Book_Image_Sources[3];
B_RI.src=B_Pre_Img[4].src;
B_RI.lnk=Book_Image_Sources[5];
B_LI.onclick=B_MI.onclick=B_RI.onclick=B_LdLnk;
B_LI.onmouseover=B_MI.onmouseover=B_RI.onmouseover=B_Stp;
B_LI.onmouseout=B_MI.onmouseout=B_RI.onmouseout=B_Rstrt;
BookImages()}}

function BookImages(){
if(!B_Stppd){
if(Book_Vertical_Turn){
B_MSz=Math.abs(Math.round(Math.cos(B_Angle)*Book_Image_Height));
MidOffset=!B_Direction?Book_Image_Height+1:Book_Image_Height-B_MSz;
B_MI.style.top=MidOffset+"px";
B_MI.style.height=B_MSz+"px"}
else{ B_MSz=Math.abs(Math.round(Math.cos(B_Angle)*Book_Image_Width));
MidOffset=B_Direction?Book_Image_Width+1:Book_Image_Width-B_MSz;
B_MI.style.left=MidOffset+"px";
B_MI.style.width=B_MSz+"px"}
B_Angle+=Book_Speed/720*Math.PI;
if(B_Angle>=Math.PI/2&&B_Direction){
B_Direction=0;
if(B_CrImg==Book_Image_Sources.length)B_CrImg=0;
B_MI.src=B_Pre_Img[B_CrImg].src;
B_MI.lnk=Book_Image_Sources[B_CrImg+1];
B_CrImg+=2}
if(B_Angle>=Math.PI){
B_Direction=1;
B_TI=B_LI;
B_LI=B_MI;
B_MI=B_TI;
if(Book_Vertical_Turn)B_MI.style.top=0+"px";
else B_MI.style.left=Book_Image_Width+1+"px";
B_MI.src=B_RI.src;
B_MI.lnk=B_RI.lnk;

setTimeout("Book_Next_Delay()",Book_NextPage_Delay)}
else setTimeout("BookImages()",50)}
else setTimeout("BookImages()",50)}

function Book_Next_Delay(){
if(B_CrImg==Book_Image_Sources.length)B_CrImg=0;
B_RI.src=B_Pre_Img[B_CrImg].src;
B_RI.lnk=Book_Image_Sources[B_CrImg+1];
B_MI.style.zIndex=2;
B_LI.style.zIndex=1;
B_Angle=0;
B_CrImg+=2;
setTimeout("BookImages()",50)}

function B_LdLnk(){if(this.lnk)window.location.href=this.lnk}
function B_Stp(){B_Stppd=true;this.style.cursor=this.lnk?"pointer":"default"}
function B_Rstrt(){B_Stppd=false}
</script>

<div id="Book" style="position:relative">
<img src="images/placeholder.gif" width="360" height="190">
</div>
<body onload="ImageBook()">

	
	<div id="sticky-point-container" style="background-image:url(templates/Modification/images/sub-content-stickers.jpg);">
		
			
		<div class="sticky-point-1">
			<h2>Просто как раз, два, три</h2>
			<p>Все что вам необходимо -  это выбрать понравившуюся наклейку из нашего интернет- магазина (написать  нам  о своих пожеланиях), сделать заказ, и в течении нескольких дней наклейка будет у вас на руках. <a href="http://test.vedrov.ru/samokleyka/polezno/info1_1.php">Инструкция !</a></p>
		</div>
		
		<div class="sticky-point-2">
			<h2>Новинки</h2>
<p>Раздел новинки периодически обновляется, так что почаще заходите на наш сайт, чтобы ничего не упустить!</p>
<!--[if IE]>
<? 
$newIE[1]='<a href="albom1/a1_14.php"><img src="albom1/a1_14.jpg" height="164" width="200"></a>'; /// Баннер IE
$newIE[2]='<a href="albom1/a1_16.php"><img src="albom1/a1_16.jpg" height="164" width="200"></a>'; /// Баннер IE
$newIE[3]='<a href="albom2/a2_5.php"><img src="albom2/a2_5.jpg" height="164" width="200"></a>'; /// Баннер IE
$newIE[4]='<a href="albom11/a11_1.php"><img src="albom11/a11_1.jpg" height="164" width="200"></a>'; /// Баннер IE
$newIE[5]='<a href="albom6/a6_37.php"><img src="albom6/a6_37.jpg" height="164" width="200"></a>'; /// Баннер IE
$rndIE=rand(1,5);
?>
<p align=center><?=$newIE[$rndIE]?></p>
<![endif]-->

<!--[if IE]><![if !IE]><![endif]-->
<? 
$new1[1]='<a href="albom1/a1_14.php"><img src="albom1/a1_14.jpg" height="90" width="110"></a>'; /// Баннер 1
$new1[2]='<a href="albom1/a1_16.php"><img src="albom1/a1_16.jpg" height="90" width="110"></a>'; /// Баннер 1
$new1[3]='<a href="albom2/a2_5.php"><img src="albom2/a2_5.jpg" height="90" width="110"></a>'; /// Баннер 1
$new1[4]='<a href="albom11/a11_11.php"><img src="albom11/a11_11.jpg" height="90" width="110"></a>'; /// Баннер 1
$new1[5]='<a href="albom6/a6_37.php"><img src="albom6/a6_37.jpg" height="90" width="110"></a>'; /// Баннер 1

$new2[1]='<a href="albom4/a4_3.php"><img src="albom4/a4_3.jpg" height="90" width="110"></a>'; /// Баннер 2
$new2[2]='<a href="albom5/a5_20.php"><img src="albom5/a5_20.jpg" height="90" width="110"></a>'; /// Баннер 2
$new2[3]='<a href="albom5/a5_19.php"><img src="albom5/a5_19.jpg" height="90" width="110"></a>'; /// Баннер 2
$new2[4]='<a href="albom11/a11_1.php"><img src="albom11/a11_1.jpg" height="90" width="110"></a>'; /// Баннер 2
$new2[5]='<a href="albom5/a5_26.php"><img src="albom5/a5_26.jpg" height="90" width="110"></a>'; /// Баннер 2

$new3[1]='<a href="albom5/a5_29.php"><img src="albom5/a5_29.jpg" height="90" width="110"></a>'; /// Баннер 3
$new3[2]='<a href="albom5/a5_31.php"><img src="albom5/a5_31.jpg" height="90" width="110"></a>'; /// Баннер 3
$new3[3]='<a href="albom11/a11_6.php"><img src="albom11/a11_6.jpg" height="90" width="110"></a>'; /// Баннер 3
$new3[4]='<a href="albom6/a6_8.php"><img src="albom6/a6_8.jpg" height="90" width="110"></a>'; /// Баннер 3
$new3[5]='<a href="albom6/a6_43.php"><img src="albom6/a6_43.jpg" height="90" width="110"></a>'; /// Баннер 3

$new4[1]='<a href="albom7/a7_5.php"><img src="albom7/a7_5.jpg" height="90" width="110"></a>'; /// Баннер 4
$new4[2]='<a href="albom11/a11_10.php"><img src="albom11/a11_10.jpg" height="90" width="110"></a>'; /// Баннер 4
$new4[3]='<a href="albom9/a9_8.php"><img src="albom9/a9_8.jpg" height="90" width="110"></a>'; /// Баннер 4
$new4[4]='<a href="albom9/a9_9.php"><img src="albom9/a9_9.jpg" height="90" width="110"></a>'; /// Баннер 4
$new4[5]='<a href="albom10/a10_5.php"><img src="albom10/a10_5.jpg" height="90" width="110"></a>'; /// Баннер 4
$rnd=rand(1,5);

?>
			<p><?=$new1[$rnd]?><?=$new2[$rnd]?><?=$new3[$rnd]?><?=$new4[$rnd]?></p>
<!--[if IE]><![endif]><![endif]-->	
</p>
		</div>
		
		<div class="sticky-point-3">
			<h2>Блог</h2>
			<p align="center">Хотите быть в курсе последних <b>новостей</b>, знать про <b>акции</b> на сайте, высказать своё мнение или написать статью, тогда ждём Вас в <a href="http://test.vedrov.ru/samokleyka/blog" >блоге</a>!<br>
<!--[if IE]>
<p align="center"><a href="http://test.vedrov.ru/samokleyka/blog" title="Декоративные надписи"><img src="http://test.vedrov.ru/samokleyka/images/blog.png" alt="Декоративные надписи"/></a></p>
<![endif]-->
<!--[if IE]><![if !IE]><![endif]-->
<p align="center"><a href="http://test.vedrov.ru/samokleyka/blog" title="Декоративные надписи"><img src="http://test.vedrov.ru/samokleyka/images/blog.png" alt="Декоративные надписи"/></a></p>
<!--[if IE]><![endif]><![endif]-->	
			</p>
		</div>
	</div>
</div>
</div>
</div>

<div id="main-content-bloc-infinite">
<div id="main-content-bloc-infinite-top">
<div id="main-content-bloc-infinite-bottom">
<div class="product-medium222">
<table align="center" border=0 valign="middle" width=98%>
<tr align="center"> 
<td colspan=4>
<h4>Последние новости</h4>
</td>
</tr>
<tr align="center"> 
<td>
<a href="http://test.vedrov.ru/samokleyka/blog/stati/optovye-prodazhi-dlya-dillerov"><img src="http://test.vedrov.ru/samokleyka/images/blog/skidki_opt.jpg"  border="0" alt="Скидки оптовикам" width=125px height=125px/></a>
</td>
<td>
Мы предлагаем дилерам и оптовикам сотрудничать с нами на выгодных условиях! <br>
<a href="http://test.vedrov.ru/samokleyka/blog/stati/optovye-prodazhi-dlya-dillerov">Читать полностью</a>
</td>
<td>
<a href="http://test.vedrov.ru/samokleyka/blog/раздел/stati/vashi-fotografii"><img src="http://test.vedrov.ru/samokleyka/images/blog/vf.jpg"  border="0" alt="Скидки оптовикам" width=125px height=125px/></a>
</td>
<td>
Открыт новый раздел нашего блога - Ваши фотографии, в нём мы размещаем фотографии которые, Вы присылаете нам с разрешением на публикацию.<br>
<a href="http://test.vedrov.ru/samokleyka/blog/раздел/stati/vashi-fotografii">Читать полностью</a>
</td>
</tr>
<tr align="center"> 
<td>
<a href="http://test.vedrov.ru/samokleyka/blog/konkursi/luchshij-vektornyj-risunok/usloviya-konkursa/"><img src="http://test.vedrov.ru/samokleyka/images/blog/konkurs.jpg"  border="0" alt="Конкурс векторных рисунков" width=125px height=125px/></a>
</td>
<td>
Конкурс векторных рисунков. Цель конкурса сделать красивый, оригинальный векторный рисунок. Призы каждому участнику ! <br>
<a href="http://test.vedrov.ru/samokleyka/blog/konkursi/luchshij-vektornyj-risunok/usloviya-konkursa/">Читать полностью</a>
</td>
<td>
<a href="http://test.vedrov.ru/samokleyka/blog/stati/vinilovye-naklejki/dekorativnye-nadpisi-na-steny/"><img src="http://test.vedrov.ru/samokleyka/albom11/a11_1.jpg"  border="0" alt="Скидки оптовикам" width=125px height=125px/></a>
</td>
<td>
Оригинальные наклейки для ноутбуков, макбуков и нетбуков! Выберите понравившуюся наклейку или закажите свою, индивидуальную! <br>
<a href="http://test.vedrov.ru/samokleyka/blog/stati/vinilovye-naklejki/nakleki-na-noutbuk/">Читать полностью</a>
</td>
</tr>
</table>

</div>
<div class="clearfix"></div>
</div>
</div>
</div>

<script type="text/javascript">
jQuery.easing['jswing'] = jQuery.easing['swing'];
jQuery.extend( jQuery.easing,
{
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	}
});

$(document).ready(function(){
	var sliderPosition = 1;
	var animTime = 800;
	var animEffect = "easeOutQuint";
	selectSlider(sliderPosition);
	$("a.slide-prev").click(function(){
		var currentMarginLeft = $("#slider-wrapper").css("margin-left");
		var newMarginLeft = parseInt(currentMarginLeft) + 720;
		if(sliderPosition > 1){
			$("#slider-wrapper").animate({
				marginLeft: newMarginLeft
			}, animTime, animEffect);
			sliderPosition--;
		}
		else{
			$("#slider-wrapper").animate({
				marginLeft: -1440
			}, animTime, animEffect);
			sliderPosition = 3;
		}
		selectSlider(sliderPosition);
	});

	$("a.slide-next").click(function(){
		var currentMarginLeft = $("#slider-wrapper").css("margin-left");
		var newMarginLeft = parseInt(currentMarginLeft) - 720;
		if(sliderPosition < 3){
			$("#slider-wrapper").animate({
				marginLeft: newMarginLeft
			}, animTime, animEffect);
			sliderPosition++;
		}
		else{
			$("#slider-wrapper").animate({
				marginLeft: 0
			}, animTime, animEffect);
			sliderPosition = 1;
		}
		selectSlider(sliderPosition);
	});
	
	$("a.slide-1").click(function(){
		var currentMarginLeft = $("#slider-wrapper").css("margin-left");
		if(currentMarginLeft != 0){
			$("#slider-wrapper").animate({
				marginLeft: 0
			}, animTime, animEffect);
		}
		sliderPosition = 1;
		selectSlider(sliderPosition);
	});
	
	$("a.slide-2").click(function(){
		var currentMarginLeft = $("#slider-wrapper").css("margin-left");
		if(currentMarginLeft != -720){
			$("#slider-wrapper").animate({
				marginLeft: -720
			}, animTime, animEffect);
		}
		sliderPosition = 2;
		selectSlider(sliderPosition);
	});
	
	$("a.slide-3").click(function(){
		var currentMarginLeft = $("#slider-wrapper").css("margin-left");
		if(currentMarginLeft != -1440){
			$("#slider-wrapper").animate({
				marginLeft: -1440
			}, animTime, animEffect);
		}
		sliderPosition = 3;
		selectSlider(sliderPosition);
	});
	
	function selectSlider(slidei){	
		$("ul.slider-controls li").removeClass("selected");
		$("ul.slider-controls li.slide-" + slidei).addClass("selected");
	}
});
</script>
</div>

</div>
<div class="clearfix"></div>
</div>	
</div>



<?php include("templates/Blocks/footer.html");?>
<!-- *Нижняя чёрная часть сайта footer* -->

</body>
</html>
