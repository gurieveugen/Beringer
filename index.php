<?php
/**
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
<header class="page-title visible-xs">
	<h1 class="archive-title">Blog</h1>
</header>
<div class="main-news center-wrap cf">
	<h1 class="p-title hidden-xs">Blog</h1>
	<?php include("loop.php"); ?>
</div>
<?php get_footer(); ?>
