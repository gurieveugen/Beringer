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
$index++;
if($index == 2)
{
	$deal = $GLOBALS['deal']->getItems(array('posts_per_page' => 1));
	if($deal)
	{
		$item      = $deal[0];
		$time      = date('F j, Y', strtotime($item->post_date));
		$link      = get_permalink($item->ID);
		$cost      = isset($item->meta['deal_cost']) ? $item->meta['deal_cost'] : '';
		$img       = has_post_thumbnail($item->ID) ? get_the_post_thumbnail($item->ID, 'thumbnail-custom') : '<img src="http://placehold.it/95x25/ffdf43/666666" alt="no-photo">';
		$sub_title = get_post_meta( $item->ID, 'deal_sub_title', true);		
		$sub_title = $sub_title ? $sub_title : '';
		?>
		<article class="a-item adv">
			<span class="a-date"><?php echo $time; ?></span>
			<div class="content">
				<h1><a href="<?php echo $link; ?>"><?php echo $item->post_title; ?></a></h1>
				<p><?php echo wp_trim_words($item->post_content, 135); ?> </p>
				<div class="link-holder">
					<a class="link-more" href="<?php echo $link; ?>">More About Deal</a>
				</div>
			</div>
			<div class="info">
				<div class="logo hidden-xs">
					<?php echo $img; ?>
				</div>
				<h3><?php echo $cost; ?></h3>
				<p><?php echo $sub_title; ?></p>
				<div class="logo hidden-xs">
					<img alt="" src="http://wp11.miydim.com/wp-content/themes/beringer/images/logo-mark.png">
				</div>
			</div>
			<div class="angle"></div>
		</article>
		<?php
	}
	
}
?>

	<article id="post-<?php the_ID(); ?>" class="a-item">
		<span class="a-date"><?php the_time('F d, Y'); ?></span>
		<div class="content">
			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php 
				the_content(' ');
				// if(strpos($post->post_content, '<!--more-->'))
				// 	the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'theme' ) );
				// else {
				// 	the_excerpt();
				// }
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