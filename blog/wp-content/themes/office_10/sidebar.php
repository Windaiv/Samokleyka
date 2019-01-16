<div id="sidebar">
	<div class="block">
    	<h3>Данные о записи:</h3>
        <p>
        	<strong>Дата:</strong> <?php the_time('l,  jS F Y') ?><br />
            <strong>Рубрика:</strong> <?php the_category(', ') ?><br />
            <strong>Подписаться:</strong> <?php post_comments_feed_link('RSS 2.0'); ?><br />
            <strong>Обсуждение:</strong> <a href="<?php the_permalink() ?>#comments" title="<?php the_title() ?>"><?php comments_number('Нет комментариев', 'Один комментарий', '% коммент.' );?></a>
        </p>
        
        
    </div>
    <div class="blockfooter">


    </div>
    
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Post Sidebar') ) : ?>      
    <?php endif; ?>
</div>