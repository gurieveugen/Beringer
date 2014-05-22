<?php
class PostTypeFactory{
	//                                       __  _          
	//     ____  _________  ____  ___  _____/ /_(_)__  _____
	//    / __ \/ ___/ __ \/ __ \/ _ \/ ___/ __/ / _ \/ ___/
	//   / /_/ / /  / /_/ / /_/ /  __/ /  / /_/ /  __(__  ) 
	//  / .___/_/   \____/ .___/\___/_/   \__/_/\___/____/  
	// /_/              /_/                                 
    public $post_type_name;
    public $post_type_args;
    public $meta_box_context;
    private $taxonomy_name;
    private $plural;
    private $options;
    private $meta_box_title;
    private $meta_box_form_fields;

    //                    __  __              __    
    //    ____ ___  ___  / /_/ /_  ____  ____/ /____
    //   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
    //  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
    // /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  

    /**
     * Sets default values, registers the passed post type, and
     * listens for when the post is saved.
     *
     * @param string $name The name of the desired post type.
     * @param array @post_type_args Override the options.
     */
    public function __construct($name, $post_type_args = array())
    {
    	$this->_session_start();
        if (!isset($_SESSION["taxonomy_data"])) 
        {
            $_SESSION['taxonomy_data'] = array();
        }   
        
        $this->post_type_name   = strtolower($name);
        $this->post_type_args   = (array)$post_type_args;
        $this->meta_box_context = 'normal';
        
        if(!post_type_exists($this->post_type_name))
        {
            $this->init(array(&$this, "registerPostType"));    
        }

        add_action('save_post', array(&$this, 'savePost'));
        add_action('post_edit_form_tag', function() { echo ' enctype="multipart/form-data"'; });     
        wp_enqueue_style('font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css');   
    }

    /**
     * Start session if his not started
     */
    private function _session_start()
    {
    	if(session_id() == '') session_start();
    }

    /**
     * Helper method, that attaches a passed function to the 'init' WP action
     * @param function $cb Passed callback function.
     */
    private function init($cb)
    {
        add_action("init", $cb);
    }

    /**
     * Helper method, that attaches a passed function to the 'admin_init' WP action
     * @param function $cb Passed callback function.
     */
    private function adminInit($cb)
    {
        add_action("admin_init", $cb);
    }


    /**
     * Registers a new post type in the WP db.
     */
    public function registerPostType()
    {
        $n = ucwords($this->post_type_name);

        $args = array(
            "label"              => $n . 's',
            'singular_name'      => $n,
            "public"             => true,
            "publicly_queryable" => true,
            "query_var"          => true,            
            "rewrite"            => true,
            "capability_type"    => "post",
            "hierarchical"       => true,
            "menu_position"      => null,
            "supports"           => array("title", "editor", "thumbnail"),
            'has_archive'        => true);
        
        $args = array_merge($args, $this->post_type_args);
        register_post_type($this->post_type_name, $args);

        if(isset($this->post_type_args['icon_code'])) add_action('admin_enqueue_scripts', array(&$this, 'addMenuIcon'));
    }

    /**
     * Add menu icon
     */
    public function addMenuIcon()
    {
        $n = str_replace(' ', '', $this->post_type_name);
        ?>
        <style>
            #adminmenu #menu-posts-<?php echo $n; ?> .wp-menu-image:before {
                content: "\<?php echo $this->post_type_args['icon_code']; ?>";  
                font-family: 'FontAwesome' !important;
                font-size: 18px !important;
            }
        </style>
        <?php
    }


    /**
     * Registers a new taxonomy, associated with the instantiated post type.
     *
     * @param string $taxonomy_name The name of the desired taxonomy
     * @param string $plural The plural form of the taxonomy name. (Optional)
     * @param array $options A list of overrides
     */
    public function addTaxonomy($taxonomy_name, $plural = '', $options = array())
    {
        $this->plural        = empty($plural) ? $taxonomy_name.'s' : $plural;
        $this->taxonomy_name = ucwords($taxonomy_name);
        $this->init(array(&$this, 'registerTaxonomy'));
    }

    public function registerTaxonomy()
    {
        $defaults = array(
            "hierarchical"   => true,
            "label"          => $this->taxonomy_name,
            "singular_label" => $this->plural,
            "show_ui"        => true,
            "query_var"      => true,
            "rewrite"        => array("slug" => strtolower($this->taxonomy_name)));

        $this->options = is_null($this->options) ? $defaults : array_merge($defaults, $this->options);
        register_taxonomy(strtolower($this->taxonomy_name), $this->post_type_name, $this->options);
    }


    /**
     * Creates a new custom meta box in the New 'post_type' page.
     *
     * @param string $title
     * @param array $form_fields Associated array that contains the label of the input, and the desired input type. 'Title' => 'text'
     */
    public function addMetaBox($title, $form_fields = array())
    {
        $this->meta_box_title       = $title;
        $this->meta_box_form_fields = $form_fields;      
        $this->adminInit(array($this, 'configureMetaBox')); 
    }

    public function configureMetaBox()
    {   
        $id = strtolower(str_replace(' ', '_', $this->meta_box_title));
        add_meta_box($id, $this->meta_box_title, array(&$this, 'renderMetaBox'), $this->post_type_name, $this->meta_box_context, 'default', array($this->meta_box_form_fields));

        add_filter('manage_edit-'.$this->post_type_name.'_columns', array(&$this, 'columnThumb'));   
        add_action('manage_'.$this->post_type_name.'_posts_custom_column', array($this, 'columnThumbShow'), 10, 2);           
    }

    /**
     * Register new columns
     * @param  array $columns 
     * @return array
     */
    public function columnThumb($columns)
    {
        $arr = array();
        foreach ($this->meta_box_form_fields as $key => &$value) 
        {
            $arr[$key] = ucwords($key);
        }
        
        return array_merge($columns, $arr);
    }

    /**
     * Display new column
     * @param  string  $column  
     * @param  integer $post_id           
     */
    public function columnThumbShow($column, $post_id)
    {          
        $display_types = array(
			"text"     => "%s",
			"email"    => "%s",
			"textarea" => "%s",
			"checkbox" => "%s",
			"select"   => '%s',
			"file"     => "%s");

        if(isset($this->meta_box_form_fields[$column]))
        {
            $meta = get_post_meta($post_id, $this->formatControlName($column), true);
            $type = $this->meta_box_form_fields[$column];
            printf($display_types[$type], $meta);
        }       
    }

    public function renderMetaBox($post, $data)
    { 
        global $post;

        wp_nonce_field(plugin_basename(__FILE__), 'jw_nonce');

        $inputs = $data['args'][0];
        $meta   = get_post_custom($post->ID);

        foreach ($inputs as $name => $type) 
        {        	
			$id_name = $this->formatControlName($name);
			$value   = isset($meta[$id_name][0]) ? $meta[$id_name][0] : '';
			$type    = is_array($type) ? $type[0] : $type;
			$items   = isset($inputs[$name][1]) && is_array($inputs[$name][1]) ? $inputs[$name][1] : null;
			$control = $this->getControl($type, $id_name, $value, $items);
            
            array_push($_SESSION['taxonomy_data'], $id_name);
            
            ?>

            <p>
                <label><?php echo ucwords($name) . ':'; ?></label>
                <?php echo $control; ?>
            </p>
           
            <p>

                <?php
                    
                    $file = get_post_meta($post->ID, $id_name, true);
                    if ( $type === 'file' ) 
                    {                        
                        $file        = get_post_meta($post->ID, $id_name, true);
                        $file_type   = wp_check_filetype($file);
                        $image_types = array('jpeg', 'jpg', 'bmp', 'gif', 'png');
                        if (isset($file)) 
                        {
                            if (in_array($file_type['ext'], $image_types)) 
                            {
                                echo "<img src='$file' alt='' style='max-width: 400px;' />";
                            } 
                            else 
                            {
                                echo "<a href='$file'>$file</a>";
                            }
                        }
                    }
                ?>
            </p>

            <?php

        }
    }

    /**
     * When a post saved/updated in the database, this methods updates the meta box params in the db as well.
     */
    public function savePost()
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        global $post;

        if ($_POST && !wp_verify_nonce($_POST['jw_nonce'], plugin_basename(__FILE__))) return;

        // Get all the form fields that were saved in the session,
        // and update their values in the db.
        if (isset($_SESSION['taxonomy_data'])) 
        {
            foreach ($_SESSION['taxonomy_data'] as $form_name) 
            {
                if (!empty($_FILES[$form_name]) ) 
                {
                    if ( !empty($_FILES[$form_name]['tmp_name']) ) 
                    {
                        $upload = wp_upload_bits($_FILES[$form_name]['name'], null, file_get_contents($_FILES[$form_name]['tmp_name']));

                        if (isset($upload['error']) && $upload['error'] != 0) 
                        {
                            wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
                        } 
                        else 
                        {
                            update_post_meta($post->ID, $form_name, $upload['url']);
                        }
                    }
                } 
                else 
                {
                    // Make better. Have to do this, because I can't figure
                    // out a better way to deal with checkboxes. If deselected,
                    // they won't be represented here, but I still need to
                    // update the value to false to blank in the table. Hmm...
                    if (!isset($_POST[$form_name])) $_POST[$form_name] = '';
                    if (isset($post->ID) ) 
                    {
                        update_post_meta($post->ID, $form_name, $_POST[$form_name]);
                    }
                }
            }

            $_SESSION['taxonomy_data'] = array();

        }
    }

    /**
     * Get all meta data from post
     * @return mixed
     */
    public function getMeta($post_id)
    {
        $arr  = array();
        $meta = get_post_custom($post_id);
        if($this->meta_box_form_fields)
        {
            foreach ($this->meta_box_form_fields as $key => &$value) 
            {
                $name = $this->formatControlName($key);
                if(isset($meta[$name])) $arr[$name] = $meta[$name][0];
            }
            return $arr;
        }
        return false;
    }

    /**
     * Get this post type items
     * @param  array  $args
     * @return array
     */
    public function getItems($args = array())
    {
        $defaults = array(
            'posts_per_page'   => -1,
            'offset'           => 0,
            'category'         => '',
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'include'          => '',
            'exclude'          => '',
            'meta_key'         => '',
            'meta_value'       => '',
            'post_type'        => $this->post_type_name,
            'post_mime_type'   => '',
            'post_parent'      => '',
            'post_status'      => 'publish',
            'suppress_filters' => true );

        $args  = array_merge($defaults, $args);
        $posts = get_posts($args);

        foreach ($posts as &$post) 
        {
            $post->meta = $this->getMeta($post->ID);
        }
        return $posts;
    }

    /**
     * Format name to web control
     * @param  string $name
     * @return string      
     */
    public function formatControlName($name)
    {
        return $this->post_type_name.'_'.strtolower(str_replace(' ', '_', $name)); 
    }

    /**
     * Get control by type
     * @param  string $type  --- control type
     * @param  string $name  --- control name
     * @param  string $value --- current value
     * @param  mixed $items  --- array items
     * @return string        --- html code
     */
    private function getControl($type, $name, $value, $items = null)
    {
    	var_dump($items);
    	$array_types = array('select', 'table');
    	$text_types  = array(
            'text'     => '<input type="text" name="%1$s" value="%2$s" class="widefat" />',
            'email'    => '<input type="email" name="%1$s" value="%2$s" class="widefat" />',
            'textarea' => '<textarea name="%1$s" class="widefat" rows="10">%2$s</textarea>',
            'checkbox' => '<input type="checkbox" name="%1$s" value="$name" ' . $this->checked(!empty($value)) . ' />', 
            'select'   => $this->getSelectControl($name, $items, $value),               
            'file'     => '<input type="file" name="%1$s" id="%1$s" />');

    	return sprintf($text_types[$type], $name, $value);
    }

    /**
     * Generate table control
     * @param  string $name   --- control name
     * @param  array $columns --- table columns
     * @param  array $rows    --- rows with values
     * @return string         --- html code
     */
    private function getTableControl($name, $columns, $rows)
    {
    	if(!$rows OR !$columns) return '';
    	$thead = implode('</th><th>', $columns).'###end';
    	$thead = sprintf('<tr>%s</tr>', str_replace('<th>###end', '', $thead));

    	foreach ($rows as $row_key => $row_val) 
    	{
    		foreach ($row_val as $field_key => $field_val) 
    		{
    			
    		}
    	}
    }

    /**
     * Generate select control
     * @param  string $name    --- control name
     * @param  array $items    --- options for control
     * @param  string $value   --- value to select
     * @param  string $options --- custom option if u need
     * @return string          --- html code
     */
    private function getSelectControl($name, $items, $value, $options = '')
    {   
    	if(!$items) return ''; 	
    	foreach ($items as $option) 
    	{
    		$options.= sprintf('<option value="%1$s" %2$s>%1$s</option>', $option, $this->selected($value == $option));    	    
    	}    	
    	return sprintf('<select name="%1$s" class="widefat">%2$s</select>', $name, $options); 
    }

    /**
     * Helper for checkbox control
     * @param  boolean $yes --- if true return checked else empty
     * @return string 
     */
    public function checked($yes = true)
    {
    	if($yes) return 'checked="checked"';
    	return '';
    }

    /**
     * Helper for select control
     * @param  boolean $yes --- if true return selected else empty
     * @return string 
     */
    public function selected($yes = true)
    {
    	if($yes) return 'selected="selected"';
    	return '';
    }
}