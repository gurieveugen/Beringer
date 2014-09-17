<?php
/*
 * @package WordPress
 * Template Name: Transactions Page
*/
?>
<?php get_header(); ?>
<?php the_post(); ?>
<div class="breadcrumbs-area hidden-xs">
	<div class="center-wrap cf">
		<?php the_breadcrumb(); ?>
	</div>
</div>
<header class="page-title visible-xs">
	<h1><?php the_title(); ?></h1>
</header>
<div class="main-transactions center-wrap">
	<div class="page-description">
		<h1 class="p-title hidden-xs"><?php the_title(); ?></h1>
		<?php the_content(); ?>
	</div>
	<div class="filter-row cf">
		<div class="filter">
			<label>Sort By</label>
			<select name="sort-by" id="sort-by">
				<option value="-1">Type of deal</option>
				<option value="asc">ASC</option>
				<option value="desc">DESC</option>
				<option value="date">Date</option>
				<option value="title">Title</option>
			</select>
		</div>
	</div>
	<?php echo do_shortcode('[deals]'); ?>
	
</div>
<script src="<?php echo TDU; ?>/js/jquery.formstyler.min.js"></script>
<script>
	jQuery(function(){
		jQuery('.filter select').styler();  
	});
</script>
<?php get_footer(); ?>