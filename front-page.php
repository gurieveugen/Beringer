<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>

<?php get_header(); ?>
<?php 
$options = $GLOBALS['theme_options']->getAll();
$fields  = fillArray(array('million_in_aum', 'member_aboard', 'buyouts', 'company_board_sets', 'home_background_image'), $options['options']);
$imgs    = array(
	'big'   => '<img src="http://placehold.it/1920x634/ffdf43/666666" alt="Big">',
	'small' => '<img src="http://placehold.it/480x301/ffdf43/666666" alt="Small">');
extract($fields);

if($home_background_image['id'] > 0)
{
	$img_big   = wp_get_attachment_image_src($home_background_image['id'], 'big-bg-img');
	$img_small = wp_get_attachment_image_src($home_background_image['id'], 'small-bg-img');
	if($img_big && $img_small)
	{
		$imgs['big']   = sprintf('<div class="image hidden-xs" style="background-image: url(%s);"></div>', $img_big[0]);
		$imgs['small'] = sprintf('<div class="image visible-xs" style="background-image: url(%s);"></div>', $img_small[0]);
	}
}
?>

<section class="visual">
	<div class="center-wrap">
		<h2>Idea Driven Nordic Corporate Finance</h2>
		<p>Our goal is to become the pre-eminent private finance firm <br class="hidden-xs">focused on the Nordic lower middle market</p>
		<a href="<?php echo get_bloginfo('url'); ?>/our-story" class="btn-large w-234">View Our Story</a>
	</div>
	<!-- 480xauto image for small screens -->
	<?php echo $imgs['small']; ?>
	<!-- full width image -->
	<?php echo $imgs['big']; ?>
</section>
<section class="updates-block wrap cf">
	<a href="<?php echo get_bloginfo('url'); ?>/transactions/" class="btn-updates">
		<div>
			<img src="<?php echo TDU; ?>/images/icon.png" alt="">
			<div class="holder">
				<strong>LATEST UPDATES</strong>
				<span>Latest deals &amp; updates offered</span>
			</div>
		</div>
	</a>
	<table class="updates-table hidden-xs">
		<tr>
			<td>
				<div>
					<strong><?php echo $million_in_aum; ?></strong>
					<span>million in AUM</span>
				</div>
			</td>
			<td>
				<div>
					<strong><?php echo $member_aboard; ?></strong>
					<span>member aboard</span>
				</div>
			</td>
			<td>
				<div>
					<strong><?php echo $buyouts; ?></strong>
					<span>buyouts</span>
				</div>
			</td>
			<td>
				<div>
					<strong><?php echo $company_board_sets; ?></strong>
					<span>company board sets</span>
				</div>
			</td>
		</tr>
	</table>
</section>
<?php 
$feed_items = getFeedBlockItems(); 
if($feed_items)
{
	?>
	<section class="feed-blocks">
		<div class="wrap cf">
		<?php
		foreach ($feed_items as &$item) 
		{
			$link  = get_permalink($item->ID);
			$time  = date('F j, Y', strtotime($item->post_date));			
			if(isset($item->meta['deal_featured']))
			{
				?>
				<article class="a-item adv">
					<span class="a-date"><?php echo $time; ?></span>
					<div class="content">
						<h1><?php echo $item->post_title; ?></h1>
						<div class="link-holder">
							<a href="<?php echo $link; ?>" class="link-more">More About Deal</a>
						</div>
					</div>
					<div class="info">
						<h3><?php echo $item->meta['deal_cost']; ?></h3>
						<p>Advise to Seller</p>
					</div>
					<span class="angle"></span>
				</article>
				<?php
			}
			else
			{
				?>
				<article class="a-item">
					<span class="a-date"><?php echo $time; ?></span>
					<div class="content">
						<h1><?php echo $item->post_title; ?></h1>
						<p><?php echo wp_trim_words($item->post_content, 12); ?></p>
						<div class="link-holder">
							<a href="<?php echo $link; ?>" class="link-more">Read more</a>
						</div>
					</div>
				</article>
				<?php	
			}	
		}
		?>
		</div>
	</section>
	<?php
}
?>
<?php 
$featured_page = getFeaturedPage(); 
if($featured_page)
{
	?>
	<section class="section-about bg-grey">
		<div class="center-wrap cf">
			<div class="image">
				<div>
					<a href="<?php echo $featured_page['link']; ?>">
						<?php echo $featured_page['img']; ?>
					</a>
				</div>
			</div>
			<div class="content">				
				<h2><?php echo strtoupper($featured_page['title']); ?></h2>
				<?php echo $featured_page['content']; ?>
			</div>
		</div>
	</section>
	<?php
}
?>


<?php get_footer(); ?>