<?php get_header(); ?>
<div id="whitewrap">

    <div class="wrapper">
    
        <div id="location">
            <p><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>">Блог</a> / <?php the_category(' /', 'parents' ); ?> / <?php the_title(''); ?></p>
        </div>
    
        <div id="secondary">
<?php if (have_posts()) : ?>


<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
<?php /* If this is a category archive */ if (is_category()) { ?>
<h2>Архив &#8216;<?php single_cat_title(); ?>&#8217; </h2>
<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
<h2>Статьи в которых есть &#8216;<?php single_tag_title(); ?>&#8217;</h2>
<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
<h2>Архив <?php the_time('F jS, Y'); ?></h2>
<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
<h2>Архив <?php the_time('F, Y'); ?></h2>
<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
<h2>Архив <?php the_time('Y'); ?></h2>
<?php /* If this is an author archive */ } elseif (is_author()) { ?>
<h2>Архив</h2>
<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
<h2>Архив</h2>
<?php } ?>

<?php while (have_posts()) : the_post(); ?>

<div id="postcontent">
<p>
<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title=" <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>

<span class="rdate"><?php the_time('l, j F, Y'); ?> <?php the_time('G:i'); ?></span>
<span class="rcomment"><?php comments_popup_link('Нет комментариев', '1 комментарий', 'Несколько комментариев'); ?></span>

<div class="clear"></div>

<?php the_excerpt(); ?>

<span class="rcat">Раздел: <?php the_category(', ') ?></span>
<br>
<span class="rtags"><?php the_tags('Другие метки статьи: ', ', ', ''); ?></span>
<div class="clear"></div>
</p>
</div>

<?php endwhile; ?>

<?php else : ?>

<!-- ^^^^^^^^^^^^^^ page not found + search form ^^^^^^^^^^^^^^ -->
<div id="secondary">
<h1>Не найдено</h1>

<h3>Поиск</h3>
<?php include(TEMPLATEPATH."/searchform.php"); ?>
</div>
<!-- ^^^^^^^^^^^^^^ page not found + search form ^^^^^^^^^^^^^^ -->

<?php endif; ?>

</div>
<?php get_sidebar(); ?>
        
    </div> <!-- end wrapper -->
    
</div> <!-- end whitewrap -->

<?php get_footer(); ?>