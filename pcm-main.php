<?php 
class PCM_Main {

	public static function init() {
		//add actions
		add_action( 'widgets_init', array(get_called_class(), 'register_widget') );
		add_action('pcm_show_menu', array(get_called_class(), 'show_nav'));
		add_shortcode( 'page_context_menu', array(get_called_class(), 'show_nav'));
		add_shortcode('pcm', array(get_called_class(), 'show_nav'));
	}

	public static function register_widget() {
		register_widget( 'PCM_Widget' );
	}

	public static function show_nav() {
		$options = get_option(PCM_Settings::$option_name);
		$page = get_queried_object();

		//Protection from invalid IDs, frequently used for virtual pages
		if ($page->ID < 1){
	        return;
	   	}
	  	$parent = $page->post_parent;

	   	if ($parent == 0) {
		//There is no parent for the page we're on
		//Check to ensure that the page we're on doesn't have children
			$children = get_children(array(
				'post_parent' => $page->ID
			));
			if (empty($children)) {
	            //Page has no children or parents, return
	            return;
	        }
	        else {
	            //Page is the section parent
	            $parent = $page;
	        }
	   	}
	    else {
	       $children = get_children(array(
	            'post_parent' => $parent
	        ));
	        $parent = get_post($parent);
	    }

	    $output = '';

	    if($options['container_elem'] != 'none') {
	    	$container = ($options['container_elem'] == 'div') ? 'div' : 'nav'; 
	    	$output .= '<'.$container.' class="'. ((!empty($options['container_class'])) ? $options['container_class'] : '') .'">';
	    }

		$output .= '<ul clas="pcm-list">';
	    $output .= '<li class="'. (($page->ID == $parent->ID) ? $options['active_class'] . ' ' . $options['li_class'] : $options['li_class']) .'"><a href="'.get_permalink($parent->ID).'">'.$parent->post_title.'</a></li>';

	   	foreach($children as $child){
	        $output .= '<li class="'. (($page->ID == $child->ID) ? $options['active_class'] . ' ' . $options['li_class'] : $options['li_class']) . '"><a href="'.get_permalink($child->ID).'">'.$child->post_title.'</a></li>';
	   	}
	   	$output .= '</ul>';

	   	if($options['container_elem'] != 'none'){
	   		$output .= '</' . $container .'>';
	   	}
	   	echo $output;
	}
}