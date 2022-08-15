<?php
/**
 * Template part for displaying events within a grid overview.
 *
 * @package Loop
 */


$title = get_the_title();

$today = get_query_var( 'today' );
$endDate = get_query_var( 'event_end' );

$about = get_field( 'about' );
$organizer = get_field( 'organizer' );
$email = get_field( 'email' );
$address = get_field( 'address' );
$latitude = get_field( 'latitude' );
$longitude = get_field( 'longitude' );

$tags = wp_get_post_terms( get_the_ID(), 'events_tag' );

?>

<article class="grid-item">

  <header class="entry-header">

    <?php if( $endDate ):
      // Calculate the remaining time difference
      $diff = $endDate - time(); //time returns current time in seconds
      $days = floor( $diff / ( 60 * 60 * 24 ) ); //seconds/minute*minutes/hour*hours/day)
      $hours = round( ( $diff - $days * 60 * 60 * 24) / ( 60 * 60 ) );

      ?>

      <?php if( $days > 0 && $days < 5 ): ?>

        <div class="remaining-time"><?php echo esc_html( 'In ' . $days . ' days and ' . $hours . ' hours' ); ?></div>

      <?php elseif( $days >= 5 ): ?>

        <div class="remaining-time"><?php echo esc_html( 'In ' . $days . ' days ' ); ?></div>

      <?php else: ?>

        <div class="remaining-time"><?php echo esc_html( 'In ' . $hours . ' hours' ); ?></div>

      <?php endif; ?>

    <?php endif; ?>

    <?php if( $title ): ?>

      <h2 class="entry-title"><?php echo esc_html( $title ); ?></h2>

    <?php endif; ?>

  </header>

  <div class="entry-content">

    <?php if( $about ): ?>

      <p class="about"><?php echo esc_html( $about ); ?></p>

    <?php endif; ?>

    <div class="event-details">

      <?php if( $organizer ): ?>

        <div class="organizer"><?php echo esc_html( $organizer ); ?></div>

      <?php endif; ?>

      <?php if( $email ): ?>

        <a href="mailto:<?php echo esc_url( $email ); ?>?subject=Event%20Enquiry" class="email" title="Email Organizer"><?php echo esc_html( $email ); ?></a>

      <?php endif; ?>

      <div class="event-address">

        <?php if( $address ): ?>

          <address class="address"><?php echo esc_html( $address ); ?></address>

        <?php endif; ?>

        <?php if( $latitude ): ?>

          <span class="latitude"><?php echo esc_html( $latitude ); ?></span>

        <?php endif; ?>

        <?php if( $longitude ): ?>

          <span class="longitude"><?php echo esc_html( $longitude ); ?></span>

        <?php endif; ?>

      </div>

    </div>

    <?php if( !empty( $tags ) ): ?>

      <div class="entry-keywords">

        <?php foreach( $tags as $keyword ): ?>

          <div class="keyword"><?php echo '#' . esc_html( $keyword->name ); ?></div>

        <?php endforeach; ?>

      </div>

    <?php endif; ?>

  </div>

</article>