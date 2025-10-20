<?php
if(!defined('ABSPATH')) exit;

/**
 * AtlasIS Smart Search Engine
 * Handles searching posts with synonyms, partial matches, fuzzy scoring, and taxonomy relevance.
 */

function atlasis_smart_search_posts($query_string){
    if(empty($query_string)) return new WP_Query(array(
        'post_type'=>'post',
        'posts_per_page'=>0
    ));

    // Define synonyms
    $synonyms = array(
        'computer'   => array('pc','laptop','notebook','desktop'),
        'web'        => array('internet','online','website','browser'),
        'security'   => array('cybersecurity','protection','safe','threats'),
        'code'       => array('programming','script','language','develop'),
        'java'       => array('jvm','jdk','jre','oop','object-oriented','java programming'),
        'python'     => array('py','python3','python2','django','flask','machine learning','ml'),
        'c++'        => array('cpp','cplusplus','oop','object-oriented','std','stl'),
        'javascript' => array('js','nodejs','react','vue','angular','es6','ecmascript'),
        'php'        => array('laravel','symfony','wordpress','backend','web development'),
    );

    // Prepare search terms
    $search_terms = explode(' ', strtolower($query_string));
    $related_terms = $search_terms;

    // Add synonyms
    foreach($search_terms as $term){
        if(isset($synonyms[$term])){
            $related_terms = array_merge($related_terms,$synonyms[$term]);
        }
    }

    // Fetch posts matching partial search
    $posts = get_posts(array(
        'post_type'      => 'post',
        'posts_per_page' => -1,
        's'              => implode(' ', $related_terms),
    ));

    // Compute fuzzy score and taxonomy boost
    $scored_posts = array();
    foreach($posts as $post){
        $score = 0;
        foreach($related_terms as $term){
            // Fuzzy match on title
            $score += 100 - levenshtein(strtolower($term), strtolower($post->post_title));

            // Partial match in title/content
            if(stripos($post->post_title, $term) !== false) $score += 50;
            if(stripos($post->post_content, $term) !== false) $score += 30;

            // Taxonomy boost
            $categories = wp_get_post_categories($post->ID, array('fields'=>'names'));
            $tags = wp_get_post_tags($post->ID, array('fields'=>'names'));
            foreach($categories as $cat){
                if(stripos($cat, $term) !== false) $score += 40;
            }
            foreach($tags as $tag){
                if(stripos($tag, $term) !== false) $score += 40;
            }
        }
        $scored_posts[] = array('post'=>$post,'score'=>$score);
    }

    // Sort by score descending
    usort($scored_posts, function($a, $b){
        return $b['score'] - $a['score'];
    });

    // Return WP_Query-like object
    $post_ids = array_map(function($item){
        return $item['post']->ID;
    }, $scored_posts);

    return new WP_Query(array(
        'post_type' => 'post',
        'post__in'  => $post_ids,
        'orderby'   => 'post__in',
        'posts_per_page' => -1
    ));
}
