<?php
/*
 * @package WordPress
 * Template Name: Services Page
*/
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : the_post(); ?>
<div class="breadcrumbs-area hidden-xs">
	<div class="center-wrap cf">
		<?php the_breadcrumb(); ?>
	</div>
</div>
<header class="page-title visible-xs">
	<h1><?php the_title(); ?></h1>
</header>
<div id="main" class="center-wrap cf">
	<article id="" class="main-content">
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="featured-image">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</article>
	<?php get_sidebar('services'); ?>
</div>
<?php endif; ?>
<?php get_footer(); ?>