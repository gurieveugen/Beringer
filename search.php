<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>

<div class="breadcrumbs-area hidden-xs">
	<div class="center-wrap cf">
		<ul class="breadcrumbs">
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li>Page Name</li>
		</ul>
	</div>
</div>
<?php if ( have_posts() ) : ?>
<header class="page-title visible-xs">
	<h1 class="archive-title"><?php printf( __( 'Search Results for: %s', 'theme' ), get_search_query() ); ?></h1>
</header>
<div class="main-news center-wrap cf">
	<h1 class="p-title hidden-xs"><?php printf( __( 'Search Results for: %s', 'theme' ), get_search_query() ); ?></h1>
	<?php include("loop.php"); ?>
</div>

<?php else : ?>
<div class="main-news center-wrap cf">
	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'theme' ); ?></p>
	<?php get_search_form(); ?>
</div>
<?php endif; ?>

<?php get_footer(); ?>
