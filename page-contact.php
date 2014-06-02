<?php
/*
 * @package WordPress
 * Template Name: Contact Page
*/
?>
<?php get_header(); ?>
<?php 
$options        = $GLOBALS['theme_options']->getAll();
$fields         = fillArray(array('address', 'email', 'tel_stockholm', 'tel_reykjavik', 'contact_background_image'), $options['contact_options']);
$fileds_options = fillArray(array('contact_background_image'), $options['contact_options']);
$imgs    = array(
	'big'   => '<img src="http://placehold.it/1920x634/ffdf43/666666" alt="BIG" class="image hidden-xs">',
	'small' => '<img src="http://placehold.it/480x301/ffdf43/666666" alt="SMALL" class="image visible-xs">');
extract($fields);
extract($fileds_options);

if($contact_background_image['id'] > 0)
{
	$img_big   = wp_get_attachment_image_src($contact_background_image['id'], 'big-bg-img');
	$img_small = wp_get_attachment_image_src($contact_background_image['id'], 'small-bg-img');
	if($img_big && $img_small)
	{
		$imgs['big']   = sprintf('<div class="image hidden-xs" style="background-image: url(%s);"></div>', $img_big[0]);
		$imgs['small'] = sprintf('<div class="image visible-xs" style="background-image: url(%s);"></div>', $img_small[0]);
	}
}
?>
<?php if ( have_posts() ) : the_post(); ?>
<header class="page-title visible-xs">
	<h1><?php the_title(); ?></h1>
</header>
<div class="main-image">
	<!-- 480xauto image for small screens -->
	<!-- <div class="image visible-xs" style="background-image: url(/wp-content/themes/beringer/images/img-3-xs.jpg);"></div> -->
	<?php echo $imgs['small']; ?>
	<!-- full width image -->
	<!-- <div class="image hidden-xs" style="background-image: url(/wp-content/themes/beringer/images/img-3.jpg);"></div> -->
	<?php echo $imgs['big']; ?>
</div>
<div class="main-contact center-wrap">
	<?php the_content(); ?>
	<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'theme' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>	
	<div class="cf contact-container">
		<div class="contact-form">
			<?php echo do_shortcode('[contact-form-7 id="37" title="Contact Form"]'); ?>
		</div>
		<div class="contact-column hidden-xs">
			<div class="col">
				<h4>Beringer Finance</h4>
				<address><?php echo $address; ?></address>
				<strong><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></strong>
			</div>
			<div class="col">
				<h4>Phone:</h4>
				<dl class="cf contact-list">
					<dt>Tel (Stockholm):</dt>
					<dd><?php echo $tel_stockholm; ?></dd>
					<dt>Tel (Reykjavik):</dt>
					<dd><?php echo $tel_reykjavik; ?></dd>
				</dl>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php get_footer(); ?>