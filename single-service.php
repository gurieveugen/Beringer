<?php get_header(); ?>

<?php if (have_posts()) : the_post(); ?>

<div class="breadcrumbs-area hidden-xs">
	<div class="center-wrap cf">
		<?php the_breadcrumb(); ?>
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
	</article>
	<?php get_sidebar('services'); ?>	
</div>
<?php endif; ?>
<?php get_footer(); ?>