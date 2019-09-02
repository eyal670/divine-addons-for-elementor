<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Modules class
 */
class Modules {

    /**
     * @var Module_Base[]
     */
    private  static $instance = null;

    public static function get_instance() {
        if ( ! self::$instance )
            self::$instance = new self;
        return self::$instance;
    }

    public function init(){
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'scripts_registered' ) );
        // add_action( 'elementor/widget/posts/skins_init',  array( $this,'skin_registered'), 1 );
    }

    public function skin_registered($widget) {
        // We check if the Elementor plugin has been installed / activated.
        if(defined('ELEMENTOR_PATH') && class_exists('ElementorPro\Modules\Posts\Skins\Skin_Cards')){
            $path = DAE_PLUGIN_PLUGIN_PATH.'modules/*/skins';
            $skin_name = glob($path.'/skin-*.php');
            foreach ( $skin_name as $skin ) {
                require_once $skin;
            }
        }
    }

    public function widgets_registered() {
        // We check if the Elementor plugin has been installed / activated.
        if( defined('ELEMENTOR_PATH') && class_exists('Elementor\Widget_Base') ){
            $path = DAE_PLUGIN_PLUGIN_PATH.'modules/*/widgets';
            $module_name = glob($path.'/widget-*.php');
            foreach ( $module_name as $widget ) {
                require_once( $widget );
            }
        }
    }

    // enqueue your custom style/script as your requirements
    public function scripts_registered() {
        // wp_enqueue_style( 'divine-editor-style', plugin_dir_url( __FILE__ ) . 'assets/css/frontend.css');
        wp_enqueue_style( 'divine-frontend-style', plugin_dir_url( __FILE__ ) . 'assets/css/editor.css');
        wp_enqueue_style('iframe-grid-css', plugin_dir_url( __FILE__ ) . 'assets/css/iframe_grid.css', array(), filemtime( plugin_dir_path( __FILE__ ) .  'assets/css/iframe_grid.css' ) );
        wp_enqueue_style('iframe-list-tobi-css', plugin_dir_url( __FILE__ ) . 'assets/tobi-lightbox/tobi.min.css' );
        wp_enqueue_script('iframe-tobi-js', plugin_dir_url( __FILE__ ) . 'assets/tobi-lightbox/tobi.min.js', array(), '1.0.0', 'true' );
        wp_enqueue_script('iframe-list-js', plugin_dir_url( __FILE__ ) . 'assets/js/iframe-list.js', array(), date("h:i:s"), 'true' );
    }
}
Modules::get_instance()->init();
