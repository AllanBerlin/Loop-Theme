<?php

/**
 * WP REST API register custom endpoints
 *
 * @since 1.0.0
 */
function loop_rest_api_register_routes_event() {

  register_rest_route( 'loop/v1', '/events', array(
    'methods'  => 'GET',
    'callback' => 'loop_rest_api_event',
    'permission_callback' => '__return_true',
  ) );
}
add_action( 'rest_api_init', 'loop_rest_api_register_routes_event' );


/**
 * WP REST API event results.
 *
 * @since 1.0.0
 * @param object $request
 */
function loop_rest_api_event( $request ) {
  $args = array(
    'post_type'       => 'events',
    'post_status'     => 'publish',
    'meta_key'		    => 'timestamp',
    'orderby'			    => 'meta_value',
    'order'				    => 'ASC',
    'posts_per_page'  => -1
  );

  $results = new WP_Query( $args );

  $activePosts = array();

  foreach( $results->posts as $post ) {
    $postID = $post->ID;

    $today = date('d-m-Y');
    $todayDate = new DateTime( $today );
    $endDate = get_field( 'timestamp', $postID );

    if( $endDate ) {
      $endDateFormatted = date( 'd-m-Y', strtotime( $endDate ) );
      $eventEnd         = new DateTime( $endDateFormatted );

      if( $eventEnd >= $todayDate ) {
        $post->acf   = get_fields( $postID );
        $post->tags  = wp_get_post_terms( $postID, 'events_tag' );
        
        $activePosts[] = $post;
      }
    }
  }

  if ( !empty( $activePosts ) ) {
    return $activePosts;
  }
}