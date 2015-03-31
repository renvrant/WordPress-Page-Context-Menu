<?php
/**
 * Plugin Name: Page Context Menu
 * Description: Shows a menu based on the hierarchical (parent/child/sibling) relationships of the page you're viewing. Widget and shortcode enabled.
 * Version: 1.0.0
 * Author: renvrant
 * Author URI: http://www.renvrant.com
 */

include_once('pcm-settings.php');
include_once('pcm-widget.php');
include_once('pcm-main.php');

PCM_Settings::init();
PCM_Main::init();