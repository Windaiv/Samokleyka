<?php get_header(); ?>

<div id="whitewrap">

    <div class="wrapper">
    
        <div id="location">
            <p><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>">Главная</a> / Результаты поиска для "<?php the_search_query(); ?>"</p>
        </div>
    
        <div id="gallery">
            <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
            
            <div class="galleryitem">
            	<a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><img src="<?php $key="thumbnail"; echo get_post_meta($post->ID, $key, true); ?>" alt="<?php the_title() ?>" /></a>
                <h3><a href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php the_title() ?></a></h3>
                <span class="categorydets">
                    <strong>Опубликовано:</strong> <?php the_time(' j F Y'); ?><br />
                    <strong>Комментирование:</strong> <a href="<?php the_permalink() ?>#comments" title="<?php the_title() ?>"><?php comments_number('Нет комментариев', 'Один комментарий', '% коммент.' );?></a>
                </span>
                <?php the_excerpt(); ?>
            </div>
            
            <?php endwhile; else: ?>
            <?php endif; ?>
        </div> <!-- end secondary -->
        
    </div> <!-- end wrapper -->
    
</div> <!-- end whitewrap -->

<?php include (TEMPLATEPATH . '/footer-gallery.php'); ?>