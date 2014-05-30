<?php

class DealWidget extends WP_Widget{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  	                                             
	function __construct() 
	{		
		parent::__construct('deal_widget', __('Display deal on sidebar'), array( 'description' => __('Add a deal block to sidebar.')));
	}

	function widget($args, $instance) 
	{
		$deal = !empty($instance['deal']) ? $GLOBALS['deal']->getItem($instance['deal']) : false;
		
		if (!$deal) return;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) ) echo $args['before_title'] . $instance['title'] . $args['after_title'];
		$link  = get_permalink($deal->ID);
		$time  = date('F j, Y', strtotime($deal->post_date));
		$angle = ($deal->meta['deal_featured'] != '') ? '<span class="angle"></span>' : '';
		?>
		<article class="a-item adv">
			<span class="a-date"><?php echo $time; ?></span>
			<div class="content">
				<h1><?php echo $deal->post_title; ?></h1>
				<div class="link-holder">
					<a href="<?php echo $link; ?>" class="link-more">More About Deal</a>
				</div>
			</div>
			<div class="info">
				<h3><?php echo $deal->meta['deal_cost']; ?></h3>
				<p>Advise to Seller</p>
			</div>
			<?php echo $angle; ?>
		</article>
		<?php

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) 
	{
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['deal']  = (int) $new_instance['deal'];
		return $instance;
	}

	function form( $instance ) 
	{
		$arr = fillArray(array('title', 'deal'), $instance);
		extract($arr);
		
		$items = $GLOBALS['deal']->getItems();
		
		if (!$items) 
		{
			echo '<p>'.sprintf( __('No deals have been created yet. <a href="%s">Create some</a>.'), admin_url('edit.php?post_type=deal') ) .'</p>';
			return;
		}

		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:') ?></label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('deal'); ?>"><?php _e('Select Deal:'); ?></label>
			<select id="<?php echo $this->get_field_id('deal'); ?>" name="<?php echo $this->get_field_name('deal'); ?>">
				<option value="-1"><?php _e( '&mdash; Select &mdash;' ) ?></option>
				<?php
				foreach ( $items as $item ) 
				{
					printf('<option value="%s" %s>%s</option>', $item->ID, selected($deal, $item->ID, false), $item->post_title);
				}
				?>
			</select>
		</p>
		<?php
	}
}