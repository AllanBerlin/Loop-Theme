<?php
/**
 * loop functions and definitions
 *
 * @package loop
 */


if ( ! function_exists( 'loop_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function loop_setup() {
    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );


    /*
     * Remove the admin-bar inline-CSS as it isn't compatible with the sticky header CSS.
     * This prevents unintended scrolling on pages with few content, when logged in.
     */
    add_theme_support ( 'admin-bar', array( 'callback' => '__return_false' ) );


    /*
     * Switch default core markup for search form
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
      'search-form',
      'gallery',
      'caption',
    ) );


    /*
     * Remove theme support for custom block templates
     */
    remove_theme_support( 'block-templates' );

  }
  endif;
add_action( 'after_setup_theme', 'loop_setup' );


/**
 * Function to be called when theme is initialised
 */
function loop_theme_init() {
  // Disable Gutenberg for posts and pages
  add_filter( 'use_block_editor_for_post', '__return_false', 10 );
  add_filter( 'use_block_editor_for_post_type', '__return_false', 10 );

  // Turn off ability to edit theme in admin
  define( 'DISALLOW_FILE_EDIT', TRUE );

  //Removes 'the_content' area (editor) from the Wordpress backend, since this theme uses ACF.
  remove_post_type_support( 'page', 'editor' );
  remove_post_type_support( 'post', 'editor' );
}
add_action( 'init', 'loop_theme_init' );


/**
 * Enqueue styles.
 */
function loop_styles() {

  // Add Google Fonts
  wp_enqueue_style( 'loop-fonts', 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap');

  wp_enqueue_style( 'loop-styles', get_template_directory_uri() . '/css/main.min.css' );

  // Remove gutenberg block styles
  wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'loop_styles', 9999 );


/**
 * Enqueue scripts and styles.
 */
function loop_scripts() {
  // Remove jquery script from frontend not the admin
  if( !is_admin() ) {
    wp_deregister_script( 'jquery' );
  }
}
add_action( 'wp_enqueue_scripts', 'loop_scripts' );


/**
 * ACF helpers.
 */
require get_template_directory() . '/inc/acf-helpers.php';

/**
 * Clean up wp_head()
 */
require get_template_directory() . '/inc/clean-head.php';

/**
 * Add Custom Post types
 */
require get_template_directory() . '/inc/custom-posts.php';

/**
 * Script to import and update Events
 */
require_once get_template_directory() . '/inc/import-events.php';

/**
 * Output all upcoming events through a Rest Api Route
 */
require get_template_directory() . '/inc/rest-api-events.php';
