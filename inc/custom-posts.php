<?php

/**
 * Register a custom post type called "events".
 */
function loop_custom_post_type_events() {
  $labels = array(
    'name'                  => _x( 'Events', 'loop' ),
    'singular_name'         => _x( 'Event', 'loop' ),
    'menu_name'             => _x( 'Events', 'loop' ),
    'name_admin_bar'        => _x( 'Events', 'loop' ),
    'add_new'               => _x( 'Add New Event', 'loop' ),
    'add_new_item'          => _x( 'Add New Event', 'loop' ),
    'new_item'              => _x( 'New Event', 'loop' ),
    'edit_item'             => _x( 'Edit Event', 'loop' ),
    'view_item'             => _x( 'View Event', 'loop' ),
    'all_items'             => _x( 'All Events', 'loop' ),
    'search_items'          => _x( 'Search Events', 'loop' ),
    'parent_item_colon'     => _x( 'Parent Event:', 'loop' ),
    'not_found'             => _x( 'No Events found.', 'loop' ),
    'not_found_in_trash'    => _x( 'No Events found in Trash.', 'loop' ),
    'featured_image'        => _x( 'Event Cover Image', 'loop' ),
    'set_featured_image'    => _x( 'Set Event image', 'loop' ),
    'remove_featured_image' => _x( 'Remove Event image', 'loop' ),
    'use_featured_image'    => _x( 'Use as Event image', 'loop' ),
    'archives'              => _x( 'Event archives', 'loop' ),
    'insert_into_item'      => _x( 'Insert into Event', 'loop' ),
    'uploaded_to_this_item' => _x( 'Uploaded to this Event', 'loop' ),
    'filter_items_list'     => _x( 'Filter Events list', 'loop' ),
    'items_list_navigation' => _x( 'Event list navigation', 'loop' ),
    'items_list'            => _x( 'Event list', 'loop' ),
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'events' ),
    'capability_type'    => 'post',
    'has_archive'        => false,
    'hierarchical'       => false,
    'taxonomies'         => array( 'events_tag' ),
    'menu_position'      => 6,
    'menu_icon'          => 'dashicons-tickets-alt',
    'supports'           => array( 'title' ),
  );

  register_post_type( 'events', $args );
}
add_action( 'init', 'loop_custom_post_type_events' );


/**
 * Register a custom tag taxonomy for the events
 */
function loop_custom_events_tag_taxonomy() {
  // custom tag labels
  $tagLabels = array(
    'name'              => _x( 'Event Tags', 'loop' ),
    'singular_name'     => _x( 'Event Tag', 'loop' ),
    'search_items'      => _x( 'Search Event Tags', 'loop' ),
    'all_items'         => _x( 'All Event Tags', 'loop' ),
    'parent_item'       => _x( 'Parent Event Tags', 'loop' ),
    'parent_item_colon' => _x( 'Parent Event Tag:', 'loop' ),
    'edit_item'         => _x( 'Edit Event Tag', 'loop' ),
    'update_item'       => _x( 'Update Event Tag', 'loop' ),
    'add_new_item'      => _x( 'Add New Event Tag', 'loop' ),
    'new_item_name'     => _x( 'New Event Tag', 'loop' ),
    'not_found'             => _x( 'No Event Tag Items found.', 'loop' ),
    'not_found_in_trash'    => _x( 'No Event Tag Items found in Trash.', 'loop' ),
  );

  // register custom tag
  register_taxonomy(
    'events_tag',
    'events',
    array(
      'hierarchical'  => false,
      'labels'        => $tagLabels,
      'rewrite'       => true,
      'query_var'     => true
    )
  );
}
add_action('init' , 'loop_custom_events_tag_taxonomy' );