<?php 
get_header();
the_post();

$meta              = get_post_custom(get_the_ID());
$meta_text_fields  = array('people_email', 'people_adress', 'people_position', 'people_education_title');
$meta_array_fields = array('people_phones', 'people_education');
$meta_texts        = sanitizeTextFields($meta_text_fields, $meta);
$meta_arrays       = sanitizeArrayFields($meta_array_fields, $meta);
$thumb             = has_post_thumbnail(get_the_ID()) ? get_the_post_thumbnail(get_the_ID(), 'people-img') : '<img src="http://placehold.it/350x350/ffdf43/666666" alt="people">';

if(is_array($meta_texts)) extract($meta_texts);
if(is_array($meta_arrays )) extract($meta_arrays);

?>
<div class="breadcrumbs-area hidden-xs">
	<div class="center-wrap cf">
		<?php the_breadcrumb(); ?>
	</div>
</div>
<header class="page-title visible-xs">
	<h1><?php the_title(); ?></h1>
</header>
<div class="main-team-detail center-wrap cf">
	<div class="td-column">
		<div class="image">
			<?php echo $thumb; ?>
		</div>
		<div class="contact-block-xs visible-xs">
			<strong><a href="mailto:<?php echo $people_email; ?>"><?php echo $people_email; ?></a></strong>
			<h4><?php echo $people_position; ?></h4>
		</div>
		<div class="contact-block hidden-xs">
			<address><?php echo $people_adress; ?></address>
			<strong><a href="mailto:<?php echo $people_email; ?>"><?php echo $people_email; ?></a></strong>
		</div>
		<div class="contact-block hidden-xs">
			<?php 
			if($people_phones)
			{
				?>
				<h4>Phone:</h4>
				<dl class="cf contact-list">
				<?php
				foreach ($people_phones as &$phone) 
				{
					printf('<dt>%s:</dt>', $phone['title']);
					printf('<dd>%s</dd>', $phone['phone']);
				}
				?>
				</dl>
				<?php
			}
			?>			
		</div>
	</div>
	<div class="td-content">
		<div class="hgroup hidden-xs">
			<h1><?php the_title(); ?></h1>
			<h5><?php echo $people_position; ?></h5>
		</div>
		<div class="td-text">
			<?php the_content(); ?>
		</div>
		<div class="td-section">
			<div class="decor-line"></div>
			<div class="titles">
				<h3>EDUCATION</h3>
				<h4><?php echo $people_education_title; ?></h4>
			</div>
			<?php 
			if($people_education)
			{
				?>
				<ul>
				<?php
				foreach ($people_education as &$education) 
				{
					printf('<li>%s</li>', $education['items']);
				}
				?>
				</ul>
				<?php
			}
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>