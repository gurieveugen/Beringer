<?php
/*
 * @package WordPress
 * Template Name: Services Page
*/
?>
<?php get_header(); ?>

<?php if (have_posts()) : the_post(); ?>

<div class="breadcrumbs-area hidden-xs">
	<div class="center-wrap cf">
		<ul class="breadcrumbs">
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li>Page Name</li>
		</ul>
	</div>
</div>
<header class="page-title visible-xs">
	<h1><?php the_title(); ?></h1>
</header>
<div id="main" class="center-wrap cf">
	<article id="content" class="main-content">
		<div class="services-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'theme' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div>
		<div class="decor-line"></div>
		<div class="services-list">
			<div class="row">
				<div class="s-item col-sm-6 col-md-4 cf">
					<div class="image hidden-xs">
						<a href="#">
							<img src="<?php echo TDU; ?>/images/img-4.jpg" alt="">
						</a>
					</div>
					<div class="text">
						<h3><a href="#">Project  co-ordination</a></h3>
						<p>Lorem ipsum dolor sit amet, consecteturm ad minim veniam, quis nostrud exercehenderit in voluptat.olor sit amet, co.</p>
					</div>
				</div>
				<div class="s-item col-sm-6 col-md-4 cf">
					<div class="image hidden-xs">
						<a href="#">
							<img src="<?php echo TDU; ?>/images/img-5.jpg" alt="">
						</a>
					</div>
					<div class="text">
						<h3><a href="#">Prep of decision material</a></h3>
						<p>Lorem ipsum dolor sit amet, consecteturm ad minim veniam, quis nostrud exercehenderit in voluptat.olor sit amet, co.</p>
					</div>
				</div>
				<div class="s-item col-sm-6 col-md-4 cf">
					<div class="image hidden-xs">
						<a href="#">
							<img src="<?php echo TDU; ?>/images/img-6.jpg" alt="">
						</a>
					</div>
					<div class="text">
						<h3><a href="#">Valuation</a></h3>
						<p>Lorem ipsum dolor sit amet, consecteturm ad minim veniam, quis nostrud exercehenderit in voluptat.olor sit amet, co.</p>
					</div>
				</div>
				<div class="s-item col-sm-6 col-md-4 cf">
					<div class="image hidden-xs">
						<a href="#">
							<img src="<?php echo TDU; ?>/images/img-7.jpg" alt="">
						</a>
					</div>
					<div class="text">
						<h3><a href="#">Tactics</a></h3>
						<p>Lorem ipsum dolor sit amet, consecteturm ad minim veniam, quis nostrud exercehenderit in voluptat.olor sit amet, co.</p>
					</div>
				</div>
				<div class="s-item col-sm-6 col-md-4 cf">
					<div class="image hidden-xs">
						<a href="#">
							<img src="<?php echo TDU; ?>/images/img-8.jpg" alt="">
						</a>
					</div>
					<div class="text">
						<h3><a href="#">Documentation</a></h3>
						<p>Lorem ipsum dolor sit amet, consecteturm ad minim veniam, quis nostrud exercehenderit in voluptat.olor sit amet, co.</p>
					</div>
				</div>
				<div class="s-item col-sm-6 col-md-4 cf">
					<div class="image hidden-xs">
						<a href="#">
							<img src="<?php echo TDU; ?>/images/img-9.jpg" alt="">
						</a>
					</div>
					<div class="text">
						<h3><a href="#">Buyers &amp; Sellers</a></h3>
						<p>Lorem ipsum dolor sit amet, consecteturm ad minim veniam, quis nostrud exercehenderit in voluptat.olor sit amet, co.</p>
					</div>
				</div>
				<div class="s-item col-sm-6 col-md-4 cf">
					<div class="image hidden-xs">
						<a href="#">
							<img src="<?php echo TDU; ?>/images/img-10.jpg" alt="">
						</a>
					</div>
					<div class="text">
						<h3><a href="#">Structure</a></h3>
						<p>Lorem ipsum dolor sit amet, consecteturm ad minim veniam, quis nostrud exercehenderit in voluptat.olor sit amet, co.</p>
					</div>
				</div>
				<div class="s-item col-sm-6 col-md-4 cf">
					<div class="image hidden-xs">
						<a href="#">
							<img src="<?php echo TDU; ?>/images/img-11.jpg" alt="">
						</a>
					</div>
					<div class="text">
						<h3><a href="#">Negotiation</a></h3>
						<p>Lorem ipsum dolor sit amet, consecteturm ad minim veniam, quis nostrud exercehenderit in voluptat.olor sit amet, co.</p>
					</div>
				</div>
			</div>
		</div>
	</article>
	<div id="sidebar">
		<aside class="widget">
			<ul class="aside-nav">	
				<li><a href="#">Overview</a></li>
				<li><a href="#">Project co-ordination</a></li>
				<li><a href="#">Prep of decision material</a></li>
				<li><a href="#">Valuation</a></li>
				<li><a href="#">Tactics</a></li>
				<li><a href="#">Documentation</a></li>
				<li><a href="#">Buyers &amp; Sellers</a></li>
				<li><a href="#">Structure</a></li>
				<li><a href="#">Negotiation</a></li>
			</ul>
		</aside>
		<aside class="widget hidden-xs">
			<aside class="a-item adv">
				<span class="a-date">April 14, 2014</span>
				<div class="content">
					<h1>Direct share issue to Bure Equity AB</h1>
					<div class="link-holder">
						<a href="#" class="link-more">More About Deal</a>
					</div>
				</div>
				<div class="info">
					<h3>SEK 36 million</h3>
					<p>Advise to Seller</p>
				</div>
				<span class="angle"></span>
			</aside>
		</aside>
	</div>
</div>
<?php endif; ?>
<?php get_footer(); ?>