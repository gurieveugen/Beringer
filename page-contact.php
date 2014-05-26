<?php
/*
 * @package WordPress
 * Template Name: Contact Page
*/
?>
<?php get_header(); ?>
<?php 
$options = $GLOBALS['theme_options']->getAll();
$fields  = fillArray(array('address', 'email', 'tel_stockholm', 'tel_reykjavik'), $options['contact_options']);
extract($fields);
?>
<?php if ( have_posts() ) : the_post(); ?>
<header class="page-title visible-xs">
	<h1><?php the_title(); ?></h1>
</header>
<div class="main-image">
	<!-- 480xauto image for small screens -->
	<div class="image visible-xs" style="background-image: url(/wp-content/themes/beringer/images/img-3-xs.jpg);"></div>
	<!-- full width image -->
	<div class="image hidden-xs" style="background-image: url(/wp-content/themes/beringer/images/img-3.jpg);"></div>
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