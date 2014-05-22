<?php
/**
 *
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<?php get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>
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
			<h4>Sub heading for education section that will lead the user.</h4>
		</div>
		<div class="news-items row">
			<article class="b-item col-sm-4">
				<span class="a-date">April 14, 2014</span>
				<div class="content">
					<h1><a href="#">This is a title of news that goes here in this spot</a></h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisic itation ullamco laboris nisi ut aliquip ex ea comm odo consequat. Duis aute irure dolor in reprehen teur sint occaecat cupidatat non p.</p>
					<div class="link-holder">
						<a href="#" class="link-more">Read more</a>
					</div>
				</div>
			</article>
			<article class="b-item col-sm-4">
				<span class="a-date">April 14, 2014</span>
				<div class="content">
					<h1><a href="#">This is a title of news that goes here in this spot</a></h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisic itation ullamco laboris nisi ut aliquip ex ea comm odo consequat. Duis aute irure dolor in reprehen teur sint occaecat cupidatat non p.</p>
					<div class="link-holder">
						<a href="#" class="link-more">Read more</a>
					</div>
				</div>
			</article>
			<article class="b-item col-sm-4">
				<span class="a-date">April 14, 2014</span>
				<div class="content">
					<h1><a href="#">This is a title of news that goes here in this spot</a></h1>
					<p>Lorem ipsum dolor sit amet, consectetur adipisic itation ullamco laboris nisi ut aliquip ex ea comm odo consequat. Duis aute irure dolor in reprehen teur sint occaecat cupidatat non p.</p>
					<div class="link-holder">
						<a href="#" class="link-more">Read more</a>
					</div>
				</div>
			</article>
		</div>
	</section>
</div>
<?php endif; ?>

<?php get_footer(); ?>