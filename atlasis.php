<?php
/**
 * Plugin Name:       AtlasIS
 * Plugin URI:        https://github.com/AndreiEnea15/atlasis
 * Description:       AtlasIS enhances WordPress search and indexing with intelligent filtering, relevance scoring, and category-based discovery.
 * Version:           1.1.0
 * Author:            Enea
 * Author URI:        https://github.com/AndreiEnea15
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update Note:       Version 1.1.0 introduces hybrid smart search — combining synonyms expansion, partial matches, fuzzy scoring, and taxonomy boosting.
 */
define('ATLASIS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('ATLASIS_PLUGIN_URL', plugin_dir_url(__FILE__));
function atlasis_enqueue_scripts() {
    wp_enqueue_style('atlasis-style', ATLASIS_PLUGIN_URL . 'assets/css/style.css', array(), '1.1.0');
    wp_enqueue_script('atlasis-script', ATLASIS_PLUGIN_URL . 'assets/js/filter.js', array('jquery'), '1.1.0', true);

    wp_localize_script('atlasis-script', 'atlasis_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('atlasis-search-nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'atlasis_enqueue_scripts');
require_once ATLASIS_PLUGIN_DIR . 'includes/shortcode-handler.php';
require_once ATLASIS_PLUGIN_DIR . 'includes/ajax-handler.php';
require_once ATLASIS_PLUGIN_DIR . 'includes/smart-search-engine.php';
