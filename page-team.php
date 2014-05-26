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
	<div class="hidden-xs page-description">
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div>
	<?php echo do_shortcode('[peoples]'); ?>	
</div>
<?php endif; ?>
<?php get_footer(); ?>