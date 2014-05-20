<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
		<footer id="footer">
			<div class="wrap cf">
				<div class="col col-one">
					<h5>Beringer Finance</h5>
					<address>Birger Jarlsgatan 4 <br> 114 34 Stockholm</address>
					<dl class="cf">
						<dt>Tel (Stockholm):</dt>
						<dd>+46 8 551 182 20</dd>
						<dt>Tel (Reykjavik):</dt>
						<dd>+46 31 760 80 75</dd>
					</dl>
					<strong><a href="mailto:info@beringerfinance.com">info@beringerfinance.com</a></strong>
				</div>
				<div class="col col-two hidden-xs">
					<?php wp_nav_menu( array(
					'container' => false,
					'theme_location' => 'bottom_nav',
					'menu_class' => 'menu'
					)); ?>
				</div>
				<div class="col col-three hidden-xs">
					<p>Our Stockholm office is centrally located in Stockholm. The nearest tube station is Östermalms Torg. Visitors with car are advised to use the parking garage at Birger Jarlsgatan.</p>
					<a href="#" class="btn">Our Team</a>
				</div>
			</div>
		</footer>
	</div>
	<?php wp_footer(); ?>
</body>
</html>