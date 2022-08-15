<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package loop
 */

get_header(); ?>

  <div class="main-content layout-module">

    <h1 class="page-title">Events List</h1>

    <?php
    $args = array(
      'post_type'       => 'events',
      'post_status'     => 'publish',
      'meta_key'		    => 'timestamp',
      'orderby'			    => 'meta_value',
      'order'				    => 'ASC',
      'posts_per_page'  => -1
    );

    $loop = new WP_Query( $args );

    ?>

    <?php if( $loop->have_posts() ): ?>

      <div class="grid grid-auto">

        <?php while( $loop->have_posts() ): $loop->the_post();
          $today = date('d-m-Y');
          $todayDate = new DateTime( $today );
          $endDate = get_field( 'timestamp', get_the_ID() );

          ?>

          <?php if( $endDate ):
            $endDateFormatted = date('d-m-Y', strtotime( $endDate ) );
            $eventEnd = new DateTime( $endDateFormatted );

            ?>

            <?php if( $eventEnd >= $todayDate  ):
              set_query_var( 'today', $today );
              set_query_var( 'event_end', strtotime( $endDate ) );

              ?>

              <?php get_template_part( 'template-parts/content', 'event' ); ?>

            <?php endif; ?>

          <?php endif; ?>

        <?php endwhile; ?><!-- end of the loop -->

        <!-- reset global post variable. After this point, we are back to the Main Query object -->
        <?php wp_reset_postdata(); ?>

      </div>

    <?php else: ?>

      <?php get_template_part( 'template-parts/content', 'none' ); ?>

    <?php endif; ?>

  </div>

<?php get_footer(); ?>