<?php
/**
 * Plugin Name: Divine addons for Elementor
 * Description: Basic Boilerplate for Custom widgets added to Elementor
 * Author: Eyal Ron
 */
if ( ! defined( 'ABSPATH' ) ) exit;
define('DAE_PLUGIN_PLUGIN_PATH', plugin_dir_path( __FILE__ ));


// plug it in
add_action('plugins_loaded', 'dae_require_files');
function dae_require_files() {
    require_once DAE_PLUGIN_PLUGIN_PATH.'modules.php';
}

 // enqueue your custom style/script as your requirements
 add_action( 'wp_enqueue_scripts', 'dae_enqueue_styles', 25);
 function dae_enqueue_styles() {
    /* if ( is_singular('demo_sites') ) { */
         wp_enqueue_style( 'divine-tobi-lightbox-style', plugin_dir_url( __FILE__ ) . 'assets/tobi-lightbox/tobi.min.css');
         wp_enqueue_script( 'divine-tobi-lightbox-script', plugin_dir_url( __FILE__ ) . 'assets/tobi-lightbox/tobi.min.js', array('jquery'), '1.0');
         wp_enqueue_script( 'divine-demo-site-script', plugin_dir_url( __FILE__ ) . 'assets/js/single-demo-site.js', array('jquery'), '1.0');
    /* } */
 }
