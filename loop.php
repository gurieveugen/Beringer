<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>

<?php if ( have_posts() ) : ?>

<div class="posts-holder">
<?php while ( have_posts() ) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" class="a-item">
		<span class="a-date"><?php the_time('F d, Y'); ?></span>
		<div class="content">
			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php 
				if(strpos($post->post_content, '<!--more-->'))
					the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'theme' ) );
				else {
					the_excerpt();
				}
			 ?>
			<div class="link-holder">
				<a href="<?php the_permalink(); ?>" class="link-more">Read more</a>
			</div>
		</div>
	</article>

<?php endwhile; ?>
</div> <!-- .posts-holder -->
	
<?php theme_paging_nav(); ?>

<?php else: ?>
	
	<h1 class="page-title"><?php _e( 'Nothing Found', 'theme' ); ?></h1>
	
	<div class="page-content">

		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'theme' ); ?></p>
		<?php get_search_form(); ?>

	</div><!-- .page-content -->
	
<?php endif; ?>