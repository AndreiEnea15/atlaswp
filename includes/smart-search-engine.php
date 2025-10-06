<?php
if (!defined('ABSPATH')) exit;

function atlaswp_smart_search_posts($query_string) {

    $synonyms = array(
        'computer' => array('pc','laptop','notebook','desktop'),
        'web'      => array('internet','online','website','browser'),
        'security' => array('cybersecurity','protection','safe','threats'),
        'code'     => array('programming','script','language','develop'),
    );

    $search_terms = explode(' ', strtolower($query_string));
    $related_terms = $search_terms;

    foreach ($search_terms as $term) {
        if (isset($synonyms[$term])) $related_terms = array_merge($related_terms, $synonyms[$term]);
    }

    return new WP_Query(array(

        'post_type'      => 'post',
        'posts_per_page' => -1,
        's'              => implode(' ', $related_terms),
        'orderby'        => 'relevance',
    ));
}
