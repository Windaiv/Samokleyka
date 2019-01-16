<div id="sidebar">

<!-- ^^^^^^^^^^^^^^ 125x125 px ads template ^^^^^^^^^^^^^^ -->
<?php include (TEMPLATEPATH . '/ads.php'); ?>
<!-- ^^^^^^^^^^^^^^ 125x125 px ads template ^^^^^^^^^^^^^^ -->

<!-- ^^^^^^^^^^^^^^ rss subscription code ^^^^^^^^^^^^^^ -->
<div class="box">
	<h2>RSS Подписка</h2>
	<div class="subscribe">

	<div class="rssfeed">Подпишись на RSS :</div>
	<div class="rssfeedlinks"><a href="<?php bloginfo('rss2_url'); ?>">Записи RSS</a><a href="<?php bloginfo('comments_rss2_url'); ?>">Комментарии RSS</a><div class="clear"></div></div>

	<div class="rssfeed">На Email :</div>
	<?php include (TEMPLATEPATH . '/feedburner.php'); ?>

	</div>
</div>
<!-- ^^^^^^^^^^^^^^ rss subscription code ^^^^^^^^^^^^^^ -->

<!-- ^^^^^^^^^^^^^^ tabbed content ^^^^^^^^^^^^^^ -->
<ul id="tabs" class="tabs">
<li><a href="#" rel="tab1" class="selected">Свежее</a></li>
<li><a href="#" rel="tab2">Комментарии</a></li>
<li><a href="#" rel="tab3">Метки</a></li>
</ul>

<div id="tab1" class="tabcontent">
<ul>
<?php query_posts('showposts=5&orderby=date'); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
<span><?php comments_popup_link('0 Comments', '1 Comment', '% Comments'); ?> </span></li>
<?php endwhile; ?>
</ul>
</div>

<div id="tab2" class="tabcontent">
<?php include (TEMPLATEPATH . '/simple_recent_comments.php'); ?>
<?php if (function_exists('src_simple_recent_comments')) { src_simple_recent_comments(5, 50, '', ''); } ?>
</div>

<div id="tab3" class="tabcontent">
<?php wp_tag_cloud('smallest=8&largest=14&number=30'); ?>
</div>

<script type="text/javascript">
var countries=new ddtabcontent("tabs")
countries.setpersist(false)
countries.setselectedClassTarget("link")
countries.init()
</script>
<!-- ^^^^^^^^^^^^^^ tabbed content ^^^^^^^^^^^^^^ -->

<div class="clear"></div>

<!-- ^^^^^^^^^^^^^^ include sidebars ^^^^^^^^^^^^^^ -->
<?php include (TEMPLATEPATH . "/sidebar1.php"); ?>
<?php include (TEMPLATEPATH . "/sidebar2.php"); ?>
<div class="clear"></div>
<!-- ^^^^^^^^^^^^^^ include sidebars ^^^^^^^^^^^^^^ -->

</div>