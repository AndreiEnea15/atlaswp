<?php
/**
 * Plugin Name:       Informaticasite Pro Index
 * Plugin URI:        https://informaticasite.com/plugins/pro-index
 * Description:       A professional article index with dynamic filters by category and tag.
 * Version:           1.0.1
 * Author:            Enea
 * Author URI:        https://informaticasite.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       informaticasite-pro-index
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define plugin constants
define( 'ISPI_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ISPI_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Enqueue scripts and styles.
 */
function ispi_enqueue_scripts() {
    // Enqueue the main stylesheet
    wp_enqueue_style( 'ispi-style', ISPI_PLUGIN_URL . 'assets/css/style.css', array(), '1.0.0' );

    // Enqueue the filter script with jQuery as a dependency
    wp_enqueue_script( 'ispi-filter-script', ISPI_PLUGIN_URL . 'assets/js/filter.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'ispi_enqueue_scripts' );

/**
 * Include the necessary shortcode handler.
 */
require_once ISPI_PLUGIN_DIR . 'includes/shortcode-handler.php';