<?php
/**
 * Plugin Name:       AtlasWP
 * Plugin URI:        https://github.com/AndreiEnea15/atlaswp
 * Description:       AtlasWP transforms your blog into a dynamic, searchable, organized article index with AI-powered search and dynamic filters.
 * Version:           1.0.2
 * Author:            Enea
 * Author URI:        https://informaticasite.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       atlaswp
 * Domain Path:       /languages
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Plugin constants
define( 'ATLASWP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ATLASWP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Enqueue scripts & styles
function atlaswp_enqueue_scripts() {
    wp_enqueue_style( 'atlaswp-style', ATLASWP_PLUGIN_URL . 'assets/css/style.css', array(), '1.0.0' );
    wp_enqueue_script( 'atlaswp-script', ATLASWP_PLUGIN_URL . 'assets/js/filter.js', array('jquery'), '1.0.0', true );

    wp_localize_script( 'atlaswp-script', 'atlaswp_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'atlaswp-search-nonce' ),
    ));
}
add_action( 'wp_enqueue_scripts', 'atlaswp_enqueue_scripts' );

// Include files
require_once ATLASWP_PLUGIN_DIR . 'includes/shortcode-handler.php';
require_once ATLASWP_PLUGIN_DIR . 'includes/ajax-handler.php';
require_once ATLASWP_PLUGIN_DIR . 'includes/smart-search-engine.php';