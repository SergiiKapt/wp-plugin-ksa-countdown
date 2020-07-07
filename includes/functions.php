<?php

add_shortcode( 'ksa_countdown', 'ksa_countdown_create_shortcode' );
function ksa_countdown_create_shortcode( $atts ){

    global $post;

    $rg = (object) shortcode_atts( [
        'id' => null
    ], $atts );


    if( ! $post = get_post( $rg->id ) )
        return '';

    $out = $post->post_content;
    wp_reset_postdata();

    return $out;
}