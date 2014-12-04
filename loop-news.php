<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>

<?php if ( have_posts() ) : ?>
<?php $index = 0; ?>
<div class="posts-holder">
<?php 
while ( have_posts() ) : 
the_post(); 
if($post->post_type == 'deal')
{
	$angle = (string)get_post_meta($post->ID, 'deal_featured', true) != '' ? '<div class="angle"></div>' : '';
	?>
	<article class="a-item adv">
		<span class="a-date"><?php the_time('F d, Y'); ?></span>
		<div class="content">
			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php 
				the_excerpt();
			 ?>
			<div class="link-holder">
				<a href="<?php the_permalink(); ?>" class="link-more">More About Deal</a>
			</div>
		</div>
		<div class="info">
			<div class="logo hidden-xs">
				<?php 
				if(has_post_thumbnail())
				{
					the_post_thumbnail('thumbnail-custom');
				}
				?>
			</div>
			<h3><?php echo (string) get_post_meta( $post->ID, 'deal_cost', true ); ?></h3>
			<p><?php echo (string) get_post_meta( $post->ID, 'deal_sub_title', true ); ?></p>
			<div class="logo hidden-xs">
				<img src="<?php echo TDU; ?>/images/logo-mark.png" alt="">
			</div>
		</div>
		<?php echo $angle; ?>
	</article>
	<?
}
else
{
?>
	
	<article id="post-<?php the_ID(); ?>" class="a-item">
		<span class="a-date"><?php the_time('F d, Y'); ?></span>
		<div class="content">
			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php 
				the_excerpt();
			 ?>
			<div class="link-holder">
				<a href="<?php the_permalink(); ?>" class="link-more">Read more</a>
			</div>
		</div>
	</article>

<?php
}
endwhile; ?>
</div> <!-- .posts-holder -->
<?php theme_paging_nav(); ?>
<?php else: ?>
	
	<h1 class="page-title"><?php _e( 'Nothing Found', 'theme' ); ?></h1>
	
	<div class="page-content">

		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'theme' ); ?></p>
		<?php get_search_form(); ?>

	</div><!-- .page-content -->
	
<?php endif; ?>