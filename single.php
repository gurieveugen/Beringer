<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>
<?php
$options = $GLOBALS['theme_options']->getAll();
$fields  = fillArray(array('other_news_title'), $options['options']);
extract($fields);
?>

<?php if ( have_posts() ) : the_post(); ?>
<div class="breadcrumbs-area hidden-xs">
	<div class="center-wrap cf">		
		<?php the_breadcrumb(); ?>
	</div>
</div>
<header class="page-title visible-xs">
	<h1>News</h1>
</header>
<div class="main-single center-wrap cf">
	<h1 class="p-title hidden-xs">News</h1>
	<article class="single-article">
		<span class="a-date"><?php the_date() ?></span>
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'theme' ) . '</span>', 'after' => '</div>' ) ); ?>
	</article>

	<section class="news-area hidden-xs">
		<div class="titles">
			<h3>OTHER NEWS</h3>
			<h4><?php echo $other_news_title; ?></h4>
		</div>
		<?php echo do_shortcode('[other_news]'); ?> 		
	</section>
</div>
<?php endif; ?>

<?php get_footer(); ?>