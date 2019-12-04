<?php
/**
 * Plugin Name: Divine Iframe Grid for Elementor
 * Description: Iframes grid widget for elementor
 * Author: Divine Sites
 * Developer: Eyal Ron
 * Author URI: https://divinesites.co.il
 * License: MIT
 */
if ( ! defined( 'ABSPATH' ) ) exit;
define('DIVIGEW_PLUGIN_PLUGIN_PATH', plugin_dir_path( __FILE__ ));


// plug it in
add_action('plugins_loaded', 'divigew_require_files');
function divigew_require_files() {
    require_once DIVIGEW_PLUGIN_PLUGIN_PATH.'modules.php';
}