<?php
/*
 * @package WordPress
 * Template Name: 	News Page
*/
?>
<?php get_header(); ?>
<div class="breadcrumbs-area hidden-xs">
	<div class="center-wrap cf">
		<?php the_breadcrumb(); ?>
	</div>
</div>
<header class="page-title visible-xs">
	<h1><?php echo get_the_title(); ?></h1>
</header>
<div class="main-news center-wrap cf">
	<h1 class="p-title hidden-xs"><?php echo get_the_title(); ?></h1>
	<?php
	$page = max(0, ((int) get_query_var('paged') -1 ));
	$offset = $page * ((int) get_option('posts_per_page'));
	query_posts( 
		array(
			'posts_per_page'   => (int) get_option('posts_per_page'),
			'offset'           => $offset,
			'category'         => array(4),
			'category_name'    => '',
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => array('post', 'deal'),
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		)
	);
	
	?>
	<?php include("loop-news.php"); ?>
</div>
<?php get_footer(); ?>