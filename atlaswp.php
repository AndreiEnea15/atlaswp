<?php
/**
 * Plugin Name:       AtlasWP
 * Plugin URI:        https://informaticasite.com/plugins/atlaswp
 * Description:       A professional article index with AI-powered search.
 * Version:           1.0.3
 * Author:            Enea
 * Author URI:        https://informaticasite.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       atlaswp

if (!defined('ABSPATH')) exit;

// Define constants
define('ATLASWP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ATLASWP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Enqueue scripts and styles
function atlaswp_enqueue_scripts() {
    wp_enqueue_style('atlaswp-style', ATLASWP_PLUGIN_URL . 'assets/css/style.css', array(), '1.0.0');
    wp_enqueue_script('atlaswp-script', ATLASWP_PLUGIN_URL . 'assets/js/filter.js', array('jquery'), '1.0.0', true);

    wp_localize_script('atlaswp-script', 'atlaswp_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('atlaswp-search-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'atlaswp_enqueue_scripts');

// Include necessary files
require_once ATLASWP_PLUGIN_DIR . 'includes/shortcode-handler.php';
require_once ATLASWP_PLUGIN_DIR . 'includes/ajax-handler.php';
require_once ATLASWP_PLUGIN_DIR . 'includes/smart-search-engine.php';

