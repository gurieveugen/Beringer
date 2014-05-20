<?php
/*
 * @package WordPress
 * Template Name: Team Page
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
<div class="main-team center-wrap">
	<div class="hidden-xs team-description">
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div>
	<div class="team-list">
		<div class="row">
			<div class="col-sm-6 col-md-4">
				<article class="t-item">
					<a href="#">
						<img src="<?php echo TDU; ?>/images/photo-1.jpg" alt="">
						<div class="text">
							<h1>Aðalsteinn Jóhannsson</h1>
							<p>President / CEO of Beringer Finance</p>
						</div>
					</a>
				</article>
			</div>
			<div class="col-sm-6 col-md-4">
				<article class="t-item">
					<a href="#">
						<img src="<?php echo TDU; ?>/images/photo-2.jpg" alt="">
						<div class="text">
							<h1>Jónmundur Guðmarsson</h1>
							<p>VP of Beringer Finance</p>
						</div>
					</a>
				</article>
			</div>
			<div class="col-sm-6 col-md-4 hidden-xs">
				<article class="t-item quote">
					<div class="dtc">
						<q>Our goal is to become the pre-eminent private equity firm focused on the Nordic lower middle market</q>
					</div>
				</article>
			</div>
			<div class="col-sm-6 col-md-4">
				<article class="t-item">
					<a href="#">
						<img src="<?php echo TDU; ?>/images/photo-3.jpg" alt="">
						<div class="text">
							<h1>Árni Birgisson</h1>
							<p>Employee Beringer Finance</p>
						</div>
					</a>
				</article>
			</div>
			<div class="col-sm-6 col-md-4">
				<article class="t-item">
					<a href="#">
						<img src="<?php echo TDU; ?>/images/photo-4.jpg" alt="">
						<div class="text">
							<h1>Arndís Thorarensen</h1>
							<p>Employee Beringer Finance</p>
						</div>
					</a>
				</article>
			</div>
			<div class="col-sm-6 col-md-4">
				<article class="t-item">
					<a href="#">
						<img src="<?php echo TDU; ?>/images/photo-5.jpg" alt="">
						<div class="text">
							<h1>Daði Janusson</h1>
							<p>Employee of Beringer Finance</p>
						</div>
					</a>
				</article>
			</div>
			<div class="col-sm-6 col-md-4">
				<article class="t-item">
					<a href="#">
						<img src="<?php echo TDU; ?>/images/photo-6.jpg" alt="">
						<div class="text">
							<h1>Júlíus Fjeldsted</h1>
							<p>Employee Beringer Finance</p>
						</div>
					</a>
				</article>
			</div>
			<div class="col-sm-6 col-md-4 hidden-xs">
				<article class="t-item quote">
					<div class="dtc">
						<q>Our goal is to become the pre-eminent private equity firm focused on the Nordic lower middle market</q>
					</div>
				</article>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php get_footer(); ?>