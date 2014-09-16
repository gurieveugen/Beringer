<?php
/*
 * @package WordPress
 * @subpackage Base_Theme
 */

define('TDU', get_bloginfo('template_url'));

// =========================================================
// REQUIRE
// =========================================================
require_once 'includes/post_type_factory.php';
require_once 'includes/page_factory.php';
require_once 'includes/lorem_posts.php';
require_once 'includes/widget_custom_menu.php';
require_once 'includes/widget_deal.php';

// =========================================================
// HOOKS
// =========================================================
add_action('widgets_init', 'widgetsInit');
add_action('after_setup_theme', 'themeNameSetup');
add_filter('clean_url', 'addAsyncForscript', 11, 1);
add_filter('the_content', 'filter_template_url');
add_filter('get_the_content', 'filter_template_url');
add_filter('widget_text', 'filter_template_url');
add_filter('nav_menu_css_class', 'change_menu_classes');
add_action('wp_enqueue_scripts', 'scripts_method');
add_filter('the_content', 'template_url');
add_filter('get_the_content', 'template_url');
add_filter('widget_text', 'template_url');
add_filter('default_content', 'theme_default_content');
add_shortcode('peoples', 'displayPeoples');
add_shortcode('deals', 'displayDeals');
add_shortcode('services', 'displayServices');
add_shortcode('other_news', 'displayOtherNews');


// =========================================================
// THEME OPTIONS
// =========================================================
add_theme_support('automatic-feed-links');
add_theme_support('html5', array( 'search-form', 'comment-form', 'comment-list'));
add_theme_support('post-thumbnails');
add_image_size('people-img', 350, 350, true);
add_image_size('featured-page-img', 340, 256, true);
add_image_size('services-img', 268, 178, true);
add_image_size('big-bg-img', 1920, 634, true);
add_image_size('small-bg-img', 480, 301, true);
add_image_size('deal-logo-img', 95, 30, false);
add_image_size('thumbnail-custom', 150, 9999, false);


// =========================================================
// SIDEBARS & MENUS
// =========================================================
register_sidebar(array(
	'id'            => 'left-sidebar',
	'name'          => 'Left Sidebar',
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>'));

register_sidebar(array(
	'id'            => 'services-left-sidebar',
	'name'          => 'Services Left Sidebar',
	'before_widget' => '<div class="widget %2$s" id="%1$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h3>',
	'after_title'   => '</h3>'));

register_sidebar(array(
	'id'            => 'footer-sidebar',
	'name'          => 'Footer Sidebar',
	'before_widget' => '<div class="col %2$s" id="%1$s">',
	'after_widget'  => '</div>',
	'before_title'  => '<h5>',
	'after_title'   => '</h5>'));

register_nav_menus(array(
	'primary_nav' => __('Primary Navigation', 'theme'),
	'bottom_nav'  => __('Bottom Navigation', 'theme')));

// =========================================================
// PEOPLE POST TYPE
// =========================================================
$GLOBALS['people'] = new PostTypeFactory('People', array('icon_code' => 'f0c0', 'label' => 'People'));
$GLOBALS['people']->addMetaBox('Additional info', array(
	'Position'        => 'text',
	'Email'           => 'email',
	'Phones'          => array('table', array('title', 'phone')),
	'Education'       => array('table', array('items')),
	'Education title' => 'text',
	'Adress'          => 'textarea'));
// =========================================================
// DEAL POST TYPE
// =========================================================
$GLOBALS['deal'] = new PostTYpeFactory('Deal', array('icon_code' => 'f0d6'));
$GLOBALS['deal']->addMetaBox('Additional info', array(
	'Featured' => 'checkbox',
	'Cost'     => 'text', 
	'Sub title' => 'text'));
// =========================================================
// SERVICES POST TYPE
// =========================================================
$GLOBALS['pt_service'] = new PostTypeFactory('service', array('icon_code' => 'f085'));
// =========================================================
// PAGE POST TYPE [ ADD META BOX ]
// =========================================================
$GLOBALS['page_meta'] = new PostTypeFactory('page');
$GLOBALS['page_meta']->meta_box_context = 'side';
$GLOBALS['page_meta']->addMetaBox('Additional info', array('Featured page' => 'checkbox'));
// =========================================================
// THEME OPTIONS PAGE
// =========================================================
$GLOBALS['theme_options'] = new PageFactory('Theme options', array(
	'icon_code' => 'f085'));
$GLOBALS['theme_options']->addFields('Options', array(
	array('name' => 'First field text', 'type' => 'text'),
	array('name' => 'First field value', 'type' => 'text'),
	array('name' => 'Second field text', 'type' => 'text'),
	array('name' => 'Second field value', 'type' => 'text'),
	array('name' => 'Third field text', 'type' => 'text'),
	array('name' => 'Third field value', 'type' => 'text'),
	array('name' => 'Fourth field text', 'type' => 'text'),
	array('name' => 'Fourth field value', 'type' => 'text'),	
	array('name' => 'Other news title', 'type' => 'text'),
	array('name' => 'Our team quote 1', 'type' => 'text'),
	array('name' => 'Our team quote 2', 'type' => 'text'),
	array('name' => 'Language switcher', 'type' => 'checkbox'),
	array('name' => 'Home background image', 'type' => 'image')	
	));
$contact_options_fields = array(
	array('name' => 'Email', 'type' => 'text'),
	array('name' => 'Tel (Stockholm)', 'type' => 'text'),
	array('name' => 'Tel (Reykjavik)', 'type' => 'text'),
	array('name' => 'Contact background image', 'type' => 'image'),
	array('name' => 'Address', 'type' => 'textarea'));
$GLOBALS['theme_options']->addFields('Contact options', $contact_options_fields);
// =========================================================
// LOREM POSTS. JUST FOR DEBUG
// =========================================================
// $lorem_posts = new LoremPosts(array(
// 	'title' => 'Acquisition by Volution',
// 	'text'  => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerc itation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excep teur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'));
// $lorem_posts->generatePosts(15, 'deal');

function themeNameSetup()
{ 
	$domain = 'beringer';

	load_theme_textdomain( $domain, TDU.'/languages' );
}

function widgetsInit()
{
	register_widget("Custom_WP_Nav_Menu_Widget");
	register_widget("DealWidget");
}

function change_menu_classes($css_classes)
{
	$css_classes = str_replace("current-menu-item", "current-menu-item active", $css_classes);
	$css_classes = str_replace("current-menu-parent", "current-menu-parent active", $css_classes);
	return $css_classes;
}

function filter_template_url($text) 
{
	return str_replace('[template-url]',get_bloginfo('template_url'), $text);
}

function theme_paging_nav() 
{
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<div class="nav-links cf">

			<?php if ( get_next_posts_link() ) : ?>
				<?php if ( is_category('news') ) : ?>
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older news', 'theme' ) ); ?></div>
				<?php else: ?>
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'theme' ) ); ?></div>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
				<?php if ( is_category('news') ) : ?>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer news <span class="meta-nav">&rarr;</span>', 'theme' ) ); ?></div>
				<?php else: ?>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'theme' ) ); ?></div>
				<?php endif; ?>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

function theme_post_nav() 
{
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'theme' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'theme' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'theme' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

function theme_entry_date( $echo = true ) 
{
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'theme' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'theme' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}

function theme_entry_meta() 
{
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'theme' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		theme_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'theme' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'theme' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'theme' ), get_the_author() ) ),
			get_the_author()
		);
	}
}

function scripts_method() 
{
	$postfix = '-min';
	// =========================================================
	// STYLES
	// =========================================================
	
	wp_enqueue_style('main', TDU.'/style'.$postfix.'.css', array(), false, 'all');
	wp_enqueue_style('xs', TDU.'/css/xs'.$postfix.'.css', array(), false, '(min-width: 480px)');
	wp_enqueue_style('sm', TDU.'/css/sm'.$postfix.'.css', array(), false, '(min-width: 768px)');
	wp_enqueue_style('md', TDU.'/css/md'.$postfix.'.css', array(), false, '(min-width: 980px)');
	wp_enqueue_style('lg', TDU.'/css/lg'.$postfix.'.css', array(), false, '(min-width: 1170px)');

	wp_deregister_script('jquery');
	wp_register_script('jquery', TDU.'/js/jquery-1.11.0.min.js');
	wp_enqueue_script('jquery');
	wp_enqueue_script('isotope', TDU.'/js/isotope.pkgd.min.js', array('jquery'));
	wp_enqueue_script('main', TDU.'/js/jquery.main'.$postfix.'.js', array('jquery'));
}

// register tag [template-url]
function template_url($text) 
{
	return str_replace('[template-url]',get_bloginfo('template_url'), $text);
}


function theme_default_content( $content ) 
{
	$content = "<p>Lorem ipsum dolor sit amet, consecteturm ad minim veniam, quis nostrud exercehenderit in voluptat.olor sit amet, co.</p><!--more--><p>Aliquam metus libero, elementum et malesuada fermentum, sagittis et libero. Nullam quis odio vel ipsum facilisis viverra id sit amet nibh. Vestibulum ullamcorper luctus lacinia. Etiam accumsan, orci eu blandit vestibulum, purus ante malesuada purus, non commodo odio ligula quis turpis. Vestibulum scelerisque feugiat diam, eu mollis elit cursus nec. Quisque commodo ultricies scelerisque. In hac habitasse platea dictumst. Nullam hendrerit rhoncus lacus, id lobortis leo condimentum sed. Nulla facilisi. Quisque ut velit a neque feugiat rutrum at sit amet neque. Sed at libero dictum est aliquam porttitor. Morbi tempor nulla ut tellus malesuada cursus condimentum metus luctus. Quisque dui neque, lobortis id vehicula et, tincidunt eget justo. Morbi vulputate velit eget leo fermentum convallis. Nam mauris risus, consectetur a posuere ultricies, elementum non orci.</p><p>Ut viverra elit vel mauris venenatis gravida ut quis mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend urna sit amet nisi scelerisque pretium. Nulla facilisi. Donec et odio vel sem gravida cursus vestibulum dapibus enim. Pellentesque eget aliquet nisl. In malesuada, quam ac interdum placerat, elit metus consequat lorem, non consequat felis ipsum et ligula. Sed varius interdum volutpat. Vestibulum et libero nisi. Maecenas sit amet risus et sapien lobortis ornare vel quis ipsum. Nam aliquet euismod aliquam. Donec velit purus, convallis ac convallis vel, malesuada vitae erat.</p>";
	return $content;
}

/**
 * Sanitize text fields
 * @param  array $fields --- which field we need to sanitize
 * @param  array $arr    --- meta array
 * @return mixed         --- sanitized array or NULL
 */
function sanitizeTextFields($fields, $arr)
{
	if(!$arr) return null;	
	foreach ($fields as &$field) 
	{	
		$new_arr[$field] = isset($arr[$field]) ? strip_tags($arr[$field][0]) : '';
	}
	return $new_arr;
}

/**
 * Sanitize array fields
 * @param  array $fields --- which field we need to sanitize
 * @param  array $arr    --- meta array
 * @return mixed         --- sanitized array or NULL
 */
function sanitizeArrayFields($fields, $arr)
{
	if(!$arr) return null;	
	foreach ($fields as &$field) 
	{		
		$new_arr[$field] = isset($arr[$field]) && unserialize($arr[$field][0]) ? unserialize($arr[$field][0]) : '';
	}
	return $new_arr;
}
	
/**
 * Display all peoples SHORTCODE
 * @return string --- html code
 */
function displayPeoples()
{
	$items   = $GLOBALS['people']->getItems();
	$options = $GLOBALS['theme_options']->getAll();
	$our_team_quote_1  = isset($options['options']['our_team_quote_1']) ? $options['options']['our_team_quote_1'] : '';	
	$our_team_quote_2  = isset($options['options']['our_team_quote_2']) ? $options['options']['our_team_quote_2'] : '';	
	$our_team_quote_1  = '<div class="col-sm-6 col-md-4 hidden-xs">
				<article class="t-item quote">
					<div class="dtc">
						<q>'.$our_team_quote_1.'</q>
					</div>
				</article>
			</div>';	
	$our_team_quote_2  = '<div class="col-sm-6 col-md-4 hidden-xs">
				<article class="t-item quote">
					<div class="dtc">
						<q>'.$our_team_quote_2.'</q>
					</div>
				</article>
			</div>';	
	if(!$items) return '';
	
	foreach ($items as &$people) 
	{
		ob_start();
		?>
		<div class="col-sm-6 col-md-4">
			<article class="t-item">
				<a href="<?php echo get_permalink($people->ID); ?>">
					<?php
					if(has_post_thumbnail($people->ID))
					{
						echo get_the_post_thumbnail($people->ID, 'people-img');
					}
					?>					
					<div class="text">
						<h1><?php echo $people->post_title; ?></h1>
						<p><?php echo $people->meta['people_position']; ?></p>
					</div>
				</a>
			</article>
		</div>
		<?php		
		$out[] = ob_get_contents();
    	ob_end_clean();
	}
	array_splice($out, 2, 0, array($our_team_quote_1));
	return sprintf('<div class="team-list"><div class="row">%1$s%2$s</div></div>', implode(' ', $out), $our_team_quote_2);
}

/**
 * Display other news SHORTCODE
 * @param  array $args --- short code properties
 * @return string      --- html code
 */
function displayOtherNews($args)
{
	$args = !is_array($args) ? array() : $args;
	$defaults = array(
		'posts_per_page'   => 3,
		'offset'           => 0,
		'category'         => '',
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true );
	$args  = array_merge($defaults, $args);
	$posts = get_posts($args);
	if(!$posts) return '';
	foreach ($posts as &$post) 
	{
		ob_start();
		$link = get_permalink($post->ID);
		$time = date('F j, Y', strtotime($post->post_date));
		?>
		<article class="b-item col-sm-4">
			<span class="a-date"><?php echo $time; ?></span>
			<div class="content">
				<h1><a href="<?php echo $link; ?>"><?php echo $post->post_title; ?></a></h1>
				<p><?php echo apply_filters('get_the_excerpt', $post->post_excerpt); ?></p>
				<div class="link-holder">
					<a href="<?php echo $link; ?>" class="link-more">Read more</a>
				</div>
			</div>
		</article>
		<?php
		$out[] = ob_get_contents();
    	ob_end_clean();
	}
	return sprintf('<div class="news-items row">%s</div>', implode(' ', $out));
}

/**
 * Display Deals SHORTCODE
 * @param  array $args --- short code properties
 * @return string      --- html code
 */
function displayDeals($args)
{
	$args  = !is_array($args) ? array() : $args; 
	$items = $GLOBALS['deal']->getItems($args);
	if(!$items) return '';
	$i = 100000000;
	$j = 0;
	foreach ($items as &$item) 
	{
		ob_start();
		$link     = get_permalink($item->ID);
		$time     = date('F j, Y', strtotime($item->post_date));
		$angel    = $item->meta['deal_featured'] != '' ? '<span class="angle"></span>' : '';
		$subtitle = $item->meta['deal_sub_title'] != '' ? $item->meta['deal_sub_title'] : '';
		$img      = has_post_thumbnail($item->ID) ? get_the_post_thumbnail($item->ID, 'deal-logo-img') : '<img src="http://placehold.it/95x25/ffdf43/666666" alt="no-photo">';
		?>
		<article class="a-item adv-t" data-asc="<?php echo $i--; ?>" data-desc="<?php echo $j++; ?>" data-date="<?php echo $item->post_date; ?>" data-title="<?php echo $item->post_title; ?>">			
			<span class="a-date"><?php echo $time; ?></span>
			<div class="col col-logo">
				<?php echo $img; ?></div>
			<div class="col col-text">
				<div class="logo">
					<?php echo $img; ?></div>
				<h1><?php echo $item->post_title; ?></h1>
				<div class="link-holder">
					<a class="link-more" href="<?php echo $link; ?>">More About Deal</a>
				</div>
			</div>
			<div class="col col-info info">
				<div class="logo">
					<img alt="" src="http://wp11.miydim.com/wp-content/themes/beringer/images/logo-mark.png"></div>
				<h3><?php echo $item->meta['deal_cost']; ?></h3>
				<p><?php echo $subtitle; ?></p>
			</div>
			<div class="col col-logo clm">
				<img alt="" src="http://wp11.miydim.com/wp-content/themes/beringer/images/logo-mark.png"></div>
			<?php echo $angel; ?>
		</article>
		<?php
		$out[] = ob_get_contents();
    	ob_end_clean();
	}
	return sprintf('<div class="transactions-list cf">%s</div>', implode(' ', $out));
}

/**
 * Display Services SHORTCODE
 * @param  array $args --- short code properties
 * @return string      --- html code
 */
function displayServices($args)
{
	$args  = !is_array($args) ? array() : $args; 
	$items = $GLOBALS['pt_service']->getItems($args);
	if(!$items) return '';

	foreach ($items as &$item) 
	{
		ob_start();
		$link  = get_permalink($item->ID);
		$img   = has_post_thumbnail($item->ID) ? get_the_post_thumbnail($item->ID, 'services-img') : '';
		?>
		<div class="s-item col-sm-6 col-md-4 cf">
			<div class="image hidden-xs">				
				<?php echo $img; ?>				
			</div>
			<div class="text">
				<h3><?php echo $item->post_title; ?></h3>
				<?php echo getShortText( $item->post_content); ?>
			</div>
		</div>
		<?php
		$out[] = ob_get_contents();
    	ob_end_clean();
	}
	return sprintf('<div class="services-list"><div class="row">%s</div></div>', implode(' ', $out));
}

function getFeedBlockItems()
{
	$args = array(
		'posts_per_page'   => 3,
		'offset'           => 0,
		'category'         => 4,
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => '',
		'meta_value'       => '',
		'post_type'        => 'post',
		'post_mime_type'   => '',
		'post_parent'      => '',		
		'post_status'      => 'publish',
		'suppress_filters' => true );

	$posts = get_posts($args);
	
	$args = array(
		'posts_per_page'   => 2,		
		'meta_key'         => 'deal_featured',
		'meta_value'       => 'deal_featured');
	$deals = $GLOBALS['deal']->getItems($args);	
	array_splice($posts, 1, 0, array($deals[0]));
	array_splice($posts, 4, 0, array($deals[1]));
	return $posts;
}

/**
 * Fill array 
 * @param  array $fields --- field list
 * @param  array $arr    --- array with values
 * @return array         --- filled array
 */
function fillArray($fields, $arr)
{
	if(!$fields) return null;
	foreach ($fields as &$field) 
	{
		$out[$field] = isset($arr[$field]) ? $arr[$field] : '';
	}
	return $out;
}

/**
 * Get featured page
 * @return array --- featured page
 */
function getFeaturedPage()
{
	$args = array(
		'posts_per_page'   => 1,
		'offset'           => 0,
		'category'         => '',
		'orderby'          => 'post_date',
		'order'            => 'DESC',
		'include'          => '',
		'exclude'          => '',
		'meta_key'         => 'page_featured_page',
		'meta_value'       => 'page_featured_page',
		'post_type'        => 'page',
		'post_mime_type'   => '',
		'post_parent'      => '',
		'post_status'      => 'publish',
		'suppress_filters' => true );
	$posts = get_posts($args);
	if($posts) 
	{
		return array(
			'link'    => get_permalink($posts[0]->ID),
			'img'     => has_post_thumbnail($posts[0]->ID) ? get_the_post_thumbnail($posts[0]->ID, 'featured-page-img') : '<img src="http://placehold.it/340x256/ffdf43/666666" alt="no-photo">',
			'title'   => $posts[0]->post_title,
			'content' => wp_trim_words($posts[0]->post_content, 135));			
	}
	return null;
	
}

/**
 * Display breadcrumbx
 */
function the_breadcrumb() 
{
	if (!is_front_page()) 
	{
		$out[] = sprintf('<a href="%s">Home</a>', get_option('home'));
		if(get_post_type() == 'people')
		{
			$out[] = sprintf('<a href="%s">People</a>', get_option('home').'our-team/');	
		}
		
		if (is_category() || is_single()) 
		{			
			$categories = get_the_category();
			$separator  = ' ';
			$output     = '';
			if($categories)
			{
				foreach($categories as $category) 
				{
					$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View alll posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
				}
				$out[] = trim($output, $separator);
			}
			
			if (is_single()) 
			{				
				$out[] = get_the_title();
			}
		} 
		else if (is_page()) 
		{
			$out[] = get_the_title();
		}
	}
	else 
	{
		$out[] = 'Home';
	}

	if($out)
	{
		echo '<ul class="breadcrumbs">';
		foreach ($out as &$el) 
		{
			printf('<li>%s</li>', $el);
		}	
		echo '</ul>';
	}
}

function getShortText($txt)
{
	$tmp = explode('<!--more-->', $txt);
	return $tmp[0];
}

function active($yes = false)
{
	return $yes ? 'active' : '';
}

function addAsyncForscript($url)
{
    if (strpos($url, '#asyncload')===false) return $url;    
    else return str_replace('#asyncload', '', $url)."' async='async"; 
}
