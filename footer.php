<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
		<footer id="footer">
			<div class="wrap cf">
				<?php 
				if(is_active_sidebar('footer-sidebar')) dynamic_sidebar('footer-sidebar'); 
				?>
				
			</div>
		</footer>
	</div>
	<?php wp_footer(); ?>
</body>
</html>