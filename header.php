<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo (wp_title( ' ', false, 'right' ) == '') ? get_bloginfo('name') : (wp_title( ' ', false, 'right' ) == ''); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" media="(min-width: 480px)" href="<?php echo TDU; ?>/css/xs.css" />
	<link rel="stylesheet" media="(min-width: 768px)" href="<?php echo TDU; ?>/css/sm.css" />
	<link rel="stylesheet" media="(min-width: 980px)" href="<?php echo TDU; ?>/css/md.css" />
	<link rel="stylesheet" media="(min-width: 1170px)" href="<?php echo TDU; ?>/css/lg.css" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); 
		wp_head(); ?>
	<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.main.js" ></script>
	<!--[if lt IE 9]>
		<script type="text/javascript" src="<?php echo TDU; ?>/js/html5.js"></script>
	<![endif]-->
	<!--[if lte IE 9]>
		<script type="text/javascript" src="<?php echo TDU; ?>/js/jquery.placeholder.min.js"></script>
		<script type="text/javascript">
			jQuery(function(){
				jQuery('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		<div class="top-bar hidden-xs">
			<div class="center-wrap cf">
				<?php
				$languages = icl_get_languages('');
				
				if(count($languages) > 1)
				{
					echo '<ul class="lang-list">';
					foreach ($languages as &$l) 
					{
						printf('<li class="%1$s"><a href="%2$s">%3$s</a></li>', active($l['active']), $l['url'], $l['language_code']);
					}
					echo '</ul>';
				}
				?>
			</div>
		</div>
		<header id="header">
			<div class="center-wrap cf">
				<strong class="logo"><a href="<?php echo home_url('/'); ?>"><img src="<?php echo TDU; ?>/images/logo.png" alt="<?php bloginfo('name'); ?>"></a></strong>
				<nav class="main-nav">
					<button class="nav-toggle visible-xs">Toggle navigation</button>
					<?php wp_nav_menu( array(
					'container' => false,
					'theme_location' => 'primary_nav',
					'menu_id' => 'nav'
					)); ?>
				</nav>
			</div>
		</header>