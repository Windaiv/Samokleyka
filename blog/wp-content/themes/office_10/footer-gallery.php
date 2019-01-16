<?php $aOptions = RevolutionOffice::initOptions(false); ?>
    <div id="footerwrap">
    
    	<div id="footer">
        
        	<div id="footertext">
				<?php echo($aOptions['footer-text']); ?><br />
                
                <!-- <?php echo get_num_queries(); ?> queries. <?php timer_stop(1); ?> seconds. -->
            </div>
        
            <div id="pagination">
            	<?php next_posts_link('<span class="navforward"></span>') ?><?php previous_posts_link('<span class="navback"></span>') ?>
            </div>
            
        </div>   
         
    </div>

<?php wp_footer(); ?>
</body>
</html>

