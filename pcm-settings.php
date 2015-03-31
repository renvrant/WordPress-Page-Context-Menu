<?php 
class PCM_Settings {
	public static $option_name = 'page_context_menu';
	public static $options;

	public static function init() {
		add_action( 'admin_menu', array( get_called_class(), 'add_menu_item' ) );
        add_action( 'admin_init', array( get_called_class(), 'settings_init' ) );
	}

	public static function add_menu_item(){
		add_options_page(
            __('Page Context Menu'),
            __('Page Context Menu'), 
            'edit_theme_options', 
            self::$option_name, 
            array( get_called_class(), 'show_menu_page' )
        );
	}

	public static function settings_init() {
		$option_name = self::$option_name;
		self::$options = get_option($option_name);
		
		if (!$options) {
			$options = array(
				'use_css' => 1,
				'container_class' => '',
				'container_elem' => 'nav',
				'li_class' => '',
				'active_class' => 'current-menu-item'
			);
			add_option($option_name, $options);
		}

		register_setting(
            $option_name, // Option group
            $option_name, // Option name
            '' // Sanitize
        );

        add_settings_section(
            $option_name, // ID
            '', // Title
            array( get_called_class(), 'show_section' ), // Callback
            $option_name // Page
        );  

        $field_args = array(
		  'type'      => 'checkbox',
	      'id'        => 'use_css',
	      'name'      => 'use_css',
	      'desc'      => '',
	      'label_for' => 'use_css'
	    );
	   //	add_settings_field( 'use_css', __('Load Default Stylesheet'), array(get_called_class(), 'show_settings'), $option_name, $option_name, $field_args );

        $field_args = array(
		  'type'      => 'text',
	      'id'        => 'container_class',
	      'name'      => 'container_class',
	      'desc'      => '',
	      'label_for' => 'container_class',
	      'maxlength' => 25
	    );

	    add_settings_field( 'container_class', __('Container Class'), array(get_called_class(), 'show_settings'), $option_name, $option_name, $field_args );

	    $field_args = array(
		  'type'      => 'select',
	      'id'        => 'container_elem',
	      'name'      => 'container_elem',
	      'desc'      => '',
	      'label_for' => 'container_elem',
	  	  'choices' => array(
	  	  		array('value' => 'nav', 'title' => 'nav'),
	  	  		array('value' => 'div', 'title' => 'div'),
	  	  		array('value' => 'none', 'title' => 'no container')
	  	  	)
	    );

	    add_settings_field( 'container_elem', __('Container Element'), array(get_called_class(), 'show_settings'), $option_name, $option_name, $field_args );

		 $field_args = array(
		  'type'      => 'text',
	      'id'        => 'li_class',
	      'name'      => 'li_class',
	      'desc'      => '',
	      'label_for' => 'li_class',
	      'maxlength' => 25
	    );

	    add_settings_field( 'li_class', __('&lt;li&gt; Class'), array(get_called_class(), 'show_settings'), $option_name, $option_name, $field_args );

		 $field_args = array(
		  'type'      => 'text',
	      'id'        => 'active_class',
	      'name'      => 'active_class',
	      'desc'      => '',
	      'label_for' => 'active_class',
	      'maxlength' => 25
	    );

	    add_settings_field( 'active_class', __('Active Class'), array(get_called_class(), 'show_settings'), $option_name, $option_name, $field_args );
 
	}
	public static function show_section() {
		//
	}
	public static function show_settings($args) {
		extract( $args );
		$options = self::$options;
		$option_name = self::$option_name;
   
    	switch ( $type ) {  
          case 'text':  
              $options[$id] = stripslashes($options[$id]);  
              $options[$id] = esc_attr( $options[$id]);
              $maxlength_attr = (!empty($maxlength)) ? "maxlength='". $maxlength . "'" : '';
              
              $output = "<input class='regular-text' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' $maxlength_attr />";
              $output .= ($desc != '') ? "<span class='description'>$desc</span>" : "";  
          break;
          case 'select':
          	$output = "<select class='regular-select' id='". $options[$id] ."' name='". $option_name . "[$id]'>";
          	foreach ($choices as $choice) {
          		$checked = ($options[$id] == $choice['value']) ? " selected" : "";
          		$output .= "<option value='" . $choice['value'] . "' $checked>" . $choice['title'] . "</option>";
          	}
          	$output .= "</select>";
          	$output .= ($desc != '') ? "<p><span class='description'>$desc</span></p><br>" : "";
          break;
          case 'checkbox':
              $checked = (isset($options[$id])) ? " checked" : "";
              $output = "<input class='regular-checkbox' type='checkbox' id='$id' name='" . $option_name . "[$id]' value='1'". $checked ." />";  
              $output .= ($desc != '') ? "<span class='description'>$desc</span>" : "";
          break;
        }
        echo $output;
	}
	public static function show_menu_page() { ?>

		<div class="wrap">
		    <h2><?php _e('Page Context Menu Settings');?></h2>

			<form method="post" enctype="multipart/form-data" action="options.php">

				<?php //settings_fields creates a nonce and sets up the form in which it is contained to save values properly
					settings_fields( self::$option_name );
					//do_settings_sections renders out the entire settings forms, with all sections and fields
					do_settings_sections( self::$option_name ); 
				?>

	   	 		<?php submit_button('Save Changes', 'primary');?>
				
			</form>
		</div>
	<?php }
}
