<?php get_header(); ?>

<div id="column">

<?php if (have_posts()) : ?>

<div class="post">
<div class="post-top"></div>
<div class="entry">

<div class="content">
<h1>Поиск</h1>

<?php while (have_posts()) : the_post(); ?>

<!-- ^^^^^^^^^^^^^^ search result ^^^^^^^^^^^^^^ -->
<div class="result">

<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title=" <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

<span class="rdate"><?php the_time('l, F j, Y'); ?> <?php the_time('G:i'); ?></span>
<span class="rcomment"><?php comments_popup_link('0 коммент.', '1 коммент.', '% коммент.'); ?></span>
<div class="clear"></div>

<div class="rsummary"><?php the_excerpt(); ?></div>

<span class="rcat">Рубрика: <?php the_category(', ') ?></span>
<span class="rtags"><?php the_tags('метки: ', ', ', ''); ?></span>
<div class="clear"></div>

</div>
<!-- ^^^^^^^^^^^^^^ search result ^^^^^^^^^^^^^^ -->

<?php endwhile; ?>
</div>

</div>
<div class="post-bottom"></div>
</div>

<!-- ^^^^^^^^^^^^^^ post navigation ^^^^^^^^^^^^^^ -->
<div class="navigation">
<div class="navleft"><?php next_posts_link('&laquo; назад') ?></div>
<div class="navright"><?php previous_posts_link('вперед &raquo;') ?></div>
<div class="clear"></div>
</div>
<!-- ^^^^^^^^^^^^^^ post navigation ^^^^^^^^^^^^^^ -->

<?php else : ?>

<!-- ^^^^^^^^^^^^^^ page not found + search form ^^^^^^^^^^^^^^ -->
<div class="post">
<div class="post-top"></div>
<div class="entry">

<div class="content">
<h1>Не найдено</h1>

<h3>Поиск</h3>
<?php include(TEMPLATEPATH."/searchform.php"); ?>
</div>

</div>
<div class="post-bottom"></div>
</div>
<!-- ^^^^^^^^^^^^^^ page not found + search form ^^^^^^^^^^^^^^ -->

<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>