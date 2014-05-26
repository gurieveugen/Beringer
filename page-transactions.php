<?php
/*
 * @package WordPress
 * Template Name: Transactions Page
*/
?>
<?php get_header(); ?>
<div class="breadcrumbs-area hidden-xs">
	<div class="center-wrap cf">
		<?php the_breadcrumb(); ?>
	</div>
</div>
<header class="page-title visible-xs">
	<h1>Transactions</h1>
</header>
<div class="main-transactions center-wrap">
	<div class="page-description">
		<h1 class="p-title hidden-xs">Transactions</h1>
		<p>Since our start in 2013 we have concluded 50 transactions including divestments, acquisitions, mergers, IPO´s and private placements in a wide variety of industries including Health Care and IT/Telecom where we consider ourselves specialists.</p>
	</div>
	<div class="filter-row cf">
		<div class="filter">
			<label>Sort By</label>
			<select>
				<option>Type of deal</option>
				<option>Option 1</option>
				<option>Option 2</option>
				<option>Option 3</option>
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